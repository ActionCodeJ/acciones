<!DOCTYPE html>

<html>

<head>

    <title>{{ $mailData['title'] }}</title>

</head>

<body>
      <p>{{ $mailData['body'] }}</p>

      <p>{{ $mailData['link'] }}

        <a href="{{ route('actions.public', Crypt::encrypt($mailData['link'] )) }}" class="btn btn-link" target="_blank">
            <i class="fas fa-link"></i> </a>

      </p>
     
    <p>{{ $mailData['footer'] }}</p>

</body>

</html>