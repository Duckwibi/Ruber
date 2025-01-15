<style>
    p{
        margin: 0;
        padding: 0;
    }
</style>
<x-mail::message>
# Your OTP

<p><strong>Your One-Time Password(OTP) is:</strong></p>
<x-mail::panel>
<p><strong>Code:</strong> {{ $otp }}</p>
</x-mail::panel>
<p><strong>Do not share this code with anyone! Your code will expire in 1 minute!</strong></p><br>

<p>Thanks,</p>
<p>Ruper</p>
</x-mail::message>