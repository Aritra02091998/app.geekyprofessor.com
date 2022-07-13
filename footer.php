<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link id="footerStyleSheet" rel="stylesheet" href="css/footer.css">
</head>

<body>
    <div class="footer-clean">
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Other Online Tools</h3>
                        <ul>

                            <li>
                                <a id="toCompressImageOnline" href="compress-image-online.php">Compress Images Free Online</a>         
                            </li>

                            <li>
                                <a id="toJPEGtoPDF" href="jpg-to-pdf-online.php">Convert JPEG To PDF Free Online</a>
                            </li>

                            <li>
                                <a id="toPNGtoJPG" href="png-to-jpg-online.php">Convert PNG to JPEG Online</a>
                            </li>

                            <li>
                                <a id="toPDFtoJPG" href="convert-pdf-to-jpg.php">PDF to JPG Free Online</a>
                            </li>

                            <li>
                                <a id="toSplitPDF" href="split-pdf-online.php">Split PDF Free Online</a>
                            </li>

                            <li>
                                <a id="toMergePDF" href="merge-pdf-online.php">Merge PDF Free Online</a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Online Calculators</h3>
                        <ul>
                            <li>
                                <a  id="toSIPCalc" href="sip-calculator.php">SIP Calculator Online India</a>
                            </li>

                            <li>
                                <a id="toGSTCalc" href="gst-calculator.php">GST Calculator India</a>
                            </li>

                            <li>
                                <a id="toCarLoanCalc" href="car-loan-emi-calculator.php">Car Loan EMI Calculator India</a>
                            </li>

                            <li>
                                <a id="toPersonalLoanCalc" href="loan-emi-calculator.php">Personal loan EMI Calculator</a>
                            </li>

                            <li>
                                <a id="toHomeLoanCalcUS" href="home-loan-emi-calculator-usa.php">Home loan calculator US</a>
                            </li>

                            <li>
                                <a id="toCarLoanUS" href="car-loan-calculator-USA.php">Car Auto Loan Calculator US</a>
                            </li>


                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Who we are:</h3>
                        <ul>
                            <li><a href="about-us.php">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="https://geekyprofessor.com/">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">apps.geekyprofessor.com © 2022-23</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        var path=window.location.pathname;
        var pageArray = path.split("/");

        if (pageArray[2] == "handlers"){
            document.getElementById("toCompressImageOnline").href = "../compress-image-online.php";
            document.getElementById("toJPEGtoPDF").href = "../jpg-to-pdf-online.php";
            document.getElementById("toPNGtoJPG").href = "../png-to-jpg-online.php";
            document.getElementById("toPDFtoJPG").href = "../convert-pdf-to-jpg.php";
            document.getElementById("toSplitPDF").href = "../split-pdf-online.php";
            document.getElementById("toMergePDF").href = "../merge-pdf-online.php";

            document.getElementById("toSIPCalc").href = "../sip-calculator.php";
            document.getElementById("toGSTCalc").href = "../gst-calculator.php";
            document.getElementById("toCarLoanCalc").href = "../car-loan-emi-calculator.php";
            document.getElementById("toPersonalLoanCalc").href = "../loan-emi-calculator.php";
            document.getElementById("toHomeLoanCalcUS").href = "../home-loan-emi-calculator-usa.php";
            document.getElementById("toCarLoanUS").href = "../car-loan-calculator-USA.php";

            document.getElementById("footerStyleSheet").href = "../css/footer.css";

        }
        console.log(pageArray);

    </script>
</body>

</html>
