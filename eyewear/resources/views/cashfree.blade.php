<form class="redirectForm" method="post" action="{{$action}}">
<input type="hidden" name="appId" value="{{$appId}}"/>
<input type="hidden" name="orderId" value="{{$orderId}}"/>
<input type="hidden" name="orderAmount" value="{{$orderAmount}}"/>
<input type="hidden" name="orderCurrency" value="{{$orderCurrency}}"/>
<input type="hidden" name="orderNote" value="{{$orderNote}}"/>
<input type="hidden" name="customerName" value="{{$customerName}}"/>
<input type="hidden" name="customerEmail" value="{{$customerEmail}}"/>
<input type="hidden" name="customerPhone" value="{{$customerPhone}}"/>
<input type="hidden" name="returnUrl" value="{{$returnUrl}}"/>
<input type="hidden" name="notifyUrl" value="{{$notifyUrl}}"/>
<input type="hidden" name="signature" value="{{$signature}}"/>

<!--<button type="submit" id="paymentbutton" class="btn btn-block btn-lg bg-ore continue-payment">Continue to Payment</button>-->

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.redirectForm').submit();
    });
</script>