@extends('layouts.app')
@section('content')
@role('accountant')
 <ul>
     <li>This WIll Show Up if U ar SuperADmin</li>
 </ul>
 @endrole
 @role('super-admin ')
<h1>This Wont Show Up   </h1>
 @endrole
@endsection     