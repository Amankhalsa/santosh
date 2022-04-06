@extends('layouts.app')

 @section('content')

    <ul class="nav nav-pills">
  <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
  <li><a href="#profile" data-toggle="tab">Profile</a></li>
  <li><a href="#messages" data-toggle="tab">Messages</a></li>
</ul>

    <div id='content' class="tab-content">
      <div class="tab-pane active" id="home">
        <ul>
            <li>home</li>
            <li>home</li>
            <li>home</li>
            <li>home</li>
        </ul>
          <button>submit</button>
      </div>
      <div class="tab-pane" id="profile">
        <ul>
            <li>profile</li>
            <li>profile</li>
            <li>profile</li>
            <li>profile</li>
            <li>profile</li>
        </ul>
          <button>submit</button>
      </div>
      <div class="tab-pane" id="messages">
          Tetsing
      </div>
    </div>

 @endsection

