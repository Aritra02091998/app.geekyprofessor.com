<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <!-- Favicon-->
        <link id="webIcon" rel="icon" type="image/x-icon" href="assets/geekyprofessor-apps.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

    </head>

    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-lg-5">
                <a class="navbar-brand" href="index.php">Geekyprofessor Apps</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        
                        <li class="nav-item">
                            <a id="toHome" class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a id="toAboutUs" class="nav-link" href="about-us.php">About Us</a>
                        </li>
                        
                        <li class="nav-item">
                            <a id="toContactUs" class="nav-link" href="https://geekyprofessor.com/contact-us/">Contact us</a>
                        </li>

                        <li class="nav-item">
                            <a id="toDisclaimer" class="nav-link" href="disclaimer.php">Disclaimer</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script type="text/javascript">
            var path=window.location.pathname;
            var pageArray = path.split("/");

            if (pageArray[2] == "handlers"){
                document.getElementById("toHome").href = "../index.php";
                document.getElementById("toAboutUs").href = "../about-us.php";
                document.getElementById("toDisclaimer").href = "../disclaimer.php";
                document.getElementById("webIcon").href = "../assets/geekyprofessor-apps.png";

            }
            console.log(pageArray);

        </script>

    </body>
</html>
