<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use PDF;
use App\Admin_model\Admin;
use App\User;

class InvoiceController extends Controller
{
	protected $admin_data;
	protected $invoice_email;
    public function __construct(){
        ini_set('memory_limit', '-1');
    	return $this->middleware('auth:admin');
    }

    public function index(){
    	$invoices = DB::table('invoices')->orderBy('id','desc')->paginate(50);
    	return view('admin.manage-invoice',compact('invoices'));
    }

    public function send_invoice_email(Request $request){
    	$this->admin_data = Admin::where('admin_type','Admin')->first();

    	$this->invoice_email = $request->invoice_email;
    	$invoice_pdf = $request->invoice_pdf;

        $data['invoice_pdf'] = $invoice_pdf;
	
	    Mail::send('admin.send-invoice-mail', $data, function($message) use ($invoice_pdf){
		$message->to($this->invoice_email,"")
		->subject('Invoice Received From '.$this->admin_data->email)
		->attach(public_path('invoice/'.$invoice_pdf), [
                         'as' => 'invoice.pdf',
                         'mime' => 'application/pdf',
                    ])
		->from($this->admin_data->email,$this->admin_data->admin_company_name);
		});

		return back()->with('success','Invoice is sent to given email.');
    }

    public function delete_invoice(Request $request){
    	$invoice_id = $request->id;
    	$invoice = DB::table('invoices')->where('id',$invoice_id)->first();
    	$del_invoice = "invoice/".$invoice->invoice_pdf;
    	@unlink($del_invoice);
    	DB::table('invoices')->where('id',$invoice_id)->delete();
    	return back()->with('success','Invoice is deleted successfully...!');
    }

    public function generate_invoice(Request $request){
    	$order_id = $request->id;
    	$get_user_id = DB::table('orders')->where('id',$order_id)->select('order_user_id')->first();
    	$user_data = User::find($get_user_id->order_user_id);
		/* Generate Invoice */
		$data['order_id'] = $order_id;
		$data['user_data'] = $user_data;
		$data['invoice_no'] = generate_invoice_no();
		$pdf = PDF::loadView('admin.invoice', $data);
		$pdf->setOptions(['isPhpEnabled' => true,'isRemoteEnabled' => true]);
		$filename = "invoice".rand(1111111,5555555).".pdf";
		$pdf->save('invoice/'.$filename);
    
		DB::table('invoices')->insert([
		'invoice_no' => generate_invoice_no(),
		'order_id' => $order_id,
		'invoice_pdf' => $filename,
		'invoice_date' => date('Y-m-d')
		]);

		return back()->with('success','Invoice generated successfully...!');
    }

    public function invoice_search_form(Request $request){
    	$search_keyword = $request->search_keyword;
        $request->validate([
            'search_keyword' => 'required'
        ]);
        $invoices = DB::table('invoices')->where('invoice_no','LIKE','%'.$search_keyword.'%')->orWhere('order_id','LIKE','%'.$search_keyword.'%')->paginate(20);
        $invoices->appends(array(
            'search_keyword' => $search_keyword
        ));
        return view('admin.manage-invoice', compact('invoices','search_keyword'));
    }
}
