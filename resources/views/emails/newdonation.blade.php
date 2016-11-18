<h1>Congrats!</h1>
<p>Your application has successfully received a donation on fundme</p>

<br>

<p>To view details of your application please visit your application <a href="{{route('applications/view',$donation->application->id)}}">Here</a>.</p>

<table>
    <tr>
        <td>Amount:</td>
        <td>R{{\App\Fundme::getCurrency($donation->amount)}}</td>
    </tr>
    <tr>
        <td colspan="2">{!!$donation->application->getFundedProgressBar()!!}</td>
    </tr>
</table>

<br>

<p>Regards,</p>
<p><em>the Fundme team</em></p>