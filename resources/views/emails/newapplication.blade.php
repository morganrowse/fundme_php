<h1>Success!</h1>
<p>Your new application has successfully been created on fundme</p>

<br>

<p>To view details of your application please visit your application <a href="{{route('applications/view',$application->id)}}">Here</a>.</p>

<table>
    <tr>
        <td>Funding:</td>
        <td>{{$application->fundingType->name}}</td>
    </tr>
    <tr>
        <td>Institution:</td>
        <td>{{$application->institution_name}}</td>
    </tr>
    <tr>
        <td>Degree type:</td>
        <td>{{$application->degree_type}}</td>
    </tr>
    <tr>
        <td>Means:</td>
        <td>{{$application->financial_means}}</td>
    </tr>
    <tr>
        <td>Amount:</td>
        <td>R{{\App\Fundme::getCurrency($application->amount)}}</td>
    </tr>
</table>

<br>

<p>Regards,</p>
<p><em>the Fundme team</em></p>