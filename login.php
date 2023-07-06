<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="icon" href="./img/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/login.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="./img/logo.png" alt="">
        </div>
        <h2>Login</h2>
        <form>
            <input type="text" placeholder="Username" id="uname" />
            <input type="password" placeholder="Password" id="pwd" />
        </form>
        <button onclick="login()">Masuk</button>
        <ul class="error"></ul>
    </div>

    <script>
        const login = () => {
            var uname = document.querySelector("#uname");
            var pwd = document.querySelector("#pwd");

            var msg = document.querySelector(".error");
            msg.innerHTML = "";

            uname.removeAttribute("class");
            pwd.removeAttribute("class");

            if (uname.value === "") {
                msg.innerHTML += "<li>Username tidak boleh kosong</li>";
                uname.setAttribute("class", "warningBox");
            }

            if (pwd.value === "") {
                msg.innerHTML += "<li>Password tidak boleh kosong</li>";
                pwd.setAttribute("class", "warningBox");
            }

            if (msg.innerHTML == "") {
                $.ajax({
                    url: "php/loginProses.php",
                    method: "POST",
                    data: `username=${uname.value}&password=${pwd.value}`,
                    success: function(result) {
                        if (result == true) {
                            window.location.href = "index.php";
                        } else {
                            document.querySelector("#error").innerHTML += `<li>${response}</li>`;
                        }
                    }
                });
            }
        };
    </script>
</body>

</html>