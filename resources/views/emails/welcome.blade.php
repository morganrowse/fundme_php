<h1>Hello</h1>
<p>Welcome to the fundme web application</p>

<br>

<p>To access the application please visit <a href="{{route('login')}}">{{route('login')}}</a> and complete the login form with the following details.</p>

<p>Login: {{$user->email}}</p>

@if($password!=null)
    <p>Password: {{$password}}</p>
@else
    <p>Password: <em>user generated</em></p>
@endif

<br>

<p>To complete your online profile to become eligible for funding please head to the <a href="{{route('home')}}#profile">profile tab</a> and upload your documentation.</p>

<p>Regards,</p>
<p><em>the Fundme team</em></p>