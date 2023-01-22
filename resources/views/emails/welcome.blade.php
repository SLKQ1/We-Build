<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <h1>
            Welcome!
        </h1>
        
        <div>
            <p> Hello {{ $user->name }}, welcome to We Build.</p>
        </div>

        <div>
            <p>Here are some things you can do to get started:</p>
            <ul>
                <p>Wanna join a cool project?</p>
                <li>Browse the projects page. Here you can find all sorts of cool projects to join. </li>
            </ul>

            <ul>
                <p>Couldn't find anything you like? Start your own!</p>
                <li>Click the "Create Project" button, select a team size, write a description and BOOM! You have your own project.</li>
                <li>Wait for your team to fill up and start building!</li>
            </ul>
        </div>
        <a href="{{ url($domain.'/projects') }}">
            Get Started
        </a>

    </div>
    <p>Sincerely, </p>
    <p>Your friends at We Build</p>
</body>

</html>