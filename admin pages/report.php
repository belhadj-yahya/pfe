<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <link rel="stylesheet" href="../admin style/report.css">
    <title>Reports</title>
</head>

<body>
    <script src="../jquery-3.7.1.js"></script>
    <?php require_once "../inclueds/admin_side_bar.php" ?>
    <main>
        <div class="content">
            <header><img src="../admen images/open.svg" class="open" alt=""> <img src="../admen images/report.svg" alt="">
                <p>Users</p>
            </header>
            <div class="main_after_header">
                <div class="div1">
                    <h1>Generate Report</h1>
                    <p>create and generate reports about your blood donation center</p>
                </div>
                <div class="place_for_inputs">
                    <div>
                        <p>Report title</p>
                        <input type="text" class="title" name="" id="" placeholder="Enter the title of your report">
                    </div>
                    <div>
                        <p>Report Content</p>
                        <textarea name="" id="" cols="30" placeholder="Write your report content here..."></textarea>
                    </div>
                </div>
                <div class="settings10">
                    <button class="down">Donwload</button>
                    <button class="cls">clear</button>
                </div>
                <p class="errors"></p>
                <div class="before_pdf">
                    <div class="pdf_div">
                        <h1>Title</h1>
                        <p class="earap">Content....</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script src="../admen scripts/report.js"></script>
</body>

</html>