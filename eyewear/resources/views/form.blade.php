<html>
    <head>
        <title>Form</title>
    </head>
    <body>
    <form action="{{ route('send-mail') }}" method="post">
    @csrf
    @method('POST')
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name"> <br><br>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Enter your email"> <br><br>

            <label for="phone">Phone:</label>
            <input type="text" name="mobile" id="mobile" placeholder="Enter your mobile no"> <br><br>

            <label for="message">Message:</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea> <br><br>

            <input type="submit">

        </form>
    </body>
</html>
