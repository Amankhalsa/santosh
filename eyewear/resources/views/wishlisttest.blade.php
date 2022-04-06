
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product id </th>
      <th scope="col">User id </th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($getwishlist as $key => $value)
    <tr>
      <th scope="row">1</th>
      <td> {{ $value->product_id}}</td>
      <td>{{ $value->user_id}}</td>
      <td>Delete</td>
    </tr>
@endforeach
  </tbody>
</table>
