<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>test login</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi commodi quisquam, obcaecati accusantium non
        dolorum molestias voluptate nobis ut, porro mollitia unde iste debitis veritatis recusandae voluptatibus quos
        libero tempora</p>
    <form action="/show" method="POST">
        @csrf
        <label for="user">user name:</label>
        <input type="text" id="user" name="username"><br><br>
        <label for="pass">password:</label>
        <input type="password" id="pass" name="password"><br><br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>