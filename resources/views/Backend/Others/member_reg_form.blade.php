<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Bengali:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
      body{
        font-family: 'Noto Serif Bengali', serif;
        }
        body {
          background: rgb(204,204,204);
        }
        page {
          background: white;
          display: block;
          margin: 0 auto;
          margin-bottom: 0.5cm;
          /* box-shadow: 0 0 0.5cm rgba(0,0,0,0.5); */
        }
        page[size="A4"] {
          width: 21cm;
          height: 29.7cm;
        }


        @media print {
          body, page {
            margin: 0;
            box-shadow: 0;
          }
        }
        form {
          padding: 20px;
          border-radius: 6px;
          background: #fff;
          /*border: 1px solid #000; */
          }
          .banner {
          /* background: #646464; */
          position: relative;
          height: 120px;
          background-size: cover;
          display: flex;
          justify-content: center;
          align-items: center;
          text-align: center;
          border-bottom: 1px black solid;
          }

          .banner h3{
            font-size: 14px;

          }

          .banner img {
          width: 13%;
          /*margin-left: 10px;*/
          margin-right: 20px;
          }
        .colums {
          display:flex;
          justify-content:space-between;
          flex-direction:row;
          flex-wrap:wrap;
          }
          .colums div {
          width:48%;
          }
      </style>


    <title>মেম্বার তথ্য</title>
</head>
<body>
    <page size="A4">
        <header>
            <div class="logo">
            </div>
        </header>
        <style>
            .single-item{
                margin-bottom: 20px;
            }
        </style>
        <form>
            <div class="banner">
                <img src="{{asset('Backend/images')}}/{{$website_info->logo}}">
              <h3 class="logo name">{{$website_info->company_name}}</h3>
            </div>
            <h3 style="text-align:center;">গ্রাহক তথ্য যুক্ত</h3>
            <div class="colums">


                <div class="single-item">
                    <label>ব্রাঞ্চ নামঃ </label>
                    <span>.........................................................</span>
                </div>

                <div class="single-item">
                    <label>কেন্দ্র নামঃ </label>
                    <span>........................................................</span>
                </div>

                <div class="single-item">
                    <label>আবেদনের তারিখঃ </label>
                    <span>...............................................</span>
                </div>

                <div class="single-item">
                    <label>আবেদনকারীর নামঃ </label>
                    <span>.............................................</span>
                </div>

                <div class="single-item">
                    <label>স্বামী / স্ত্রীর নামঃ </label>
                    <span>..................................................</span>
                </div>

                <div class="single-item">
                    <label>পিতার নামঃ </label>
                    <span>.......................................................</span>
                </div>

                <div class="single-item">
                    <label>মাতার নামঃ </label>
                    <span>........................................................</span>
                </div>

                <div class="single-item">
                    <label>লিঙ্গঃ </label>
                    <span>...............................................................</span>
                </div>

                <div class="single-item">
                    <label>ধর্মঃ </label>
                    <span>.................................................................</span>
                </div>

                <div class="single-item">
                    <label>জন্ম তারিখঃ </label>
                    <span>.......................................................</span>
                </div>

                <div class="single-item">
                    <label>জাতীয় পরিচয় পত্র নাম্বারঃ </label>
                    <span>.......................................</span>
                </div>

                <div class="single-item">
                    <label>পেশাঃ </label>
                    <span>..............................................................</span>
                </div>

                <div class="single-item">
                    <label>ফোনঃ </label>
                    <span>...............................................................</span>
                </div>

                <div class="single-item">
                    <label>বিভাগঃ </label>
                    <span>.............................................................</span>
                </div>

                <div class="single-item">
                    <label>জেলাঃ </label>
                    <span>...............................................................</span>
                </div>

                <div class="single-item">
                    <label>উপজেলাঃ </label>
                    <span>.........................................................</span>
                </div>

                <div class="single-item">
                    <label>বর্তমান ঠিকানাঃ </label>
                    <span>.....................................................</span>
                </div>

                <div class="single-item">
                    <label>স্থায়ী ঠিকানাঃ </label>
                    <span>......................................................</span>
                </div>

                <div class="single-item">
                    <label>স্ট্যাটাসঃ </label>
                    <span>.............................................................</span>
                </div>

                <div class="single-item">
                    <label>আবেদনকারীর ছবিঃ </label>
                    <span>...............................................</span>
                </div>

                <div class="single-item">
                    <label>আবেদনকারীর জাতীয় পরিচয় পত্রঃ </label>
                    <span>...............................</span>
                </div>

                <div class="single-item">
                    <label>আবেদনকারীর স্বাক্ষরঃ </label>
                    <span>............................................</span>
                </div>
          </form>
    </page>


</body>
</html>
