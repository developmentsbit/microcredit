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


    <title>বিনিয়োগ রেজিষ্ট্রেশন</title>
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
            <h3 style="text-align:center;">বিনিয়োগ রেজিষ্ট্রেশন</h3>
            <div class="colums">

                <div class="single-item">
                    <label>তারিখঃ </label>
                    <span>............................................................</span>
                </div>

                <div class="single-item">
                    <label>ব্রাঞ্চ নামঃ </label>
                    <span>............................................................</span>
                </div>

                <div class="single-item">
                    <label>কেন্দ্র নামঃ </label>
                    <span>........................................................</span>
                </div>

                <div class="single-item">
                    <label>সদস্যের নামঃ </label>
                    <span>........................................................</span>
                </div>

                <div class="single-item">
                    <label>ডিপোজিট অ্যাকাউন্ট নাম্বারঃ </label>
                    <span>....................................</span>
                </div>

                <div class="single-item">
                    <label>ফোনঃ </label>
                    <span>.................................................................</span>
                </div>

                <div class="single-item">
                    <label>স্কিমা নির্বাচন করুনঃ </label>
                    <span>..............................................</span>
                </div>

                 <div class="single-item">
                    <label>লাভের পরিমাণ (%)ঃ </label>
                    <span>.............................................</span>
                </div>

                <div class="single-item">
                    <label>বিনিয়োগ পরিমাণঃ </label>
                    <span>................................................</span>
                </div>

                <div class="single-item">
                    <label>মোটঃ </label>
                    <span>..................................................................</span>
                </div>

                <div class="single-item">
                    <label>কিস্তির নংঃ </label>
                    <span>.........................................................</span>
                </div>

                  <div class="single-item">
                    <label>কিস্তির পরিমাণঃ </label>
                    <span>......................................................</span>
                </div>

                <div class="single-item">
                    <label>আসল টাকাঃ </label>
                    <span>.......................................................</span>
                </div>

                <div class="single-item">
                    <label>লাভের পরিমাণঃ </label>
                    <span>......................................................</span>
                </div>

                <div class="single-item">
                    <label>ঝুকির পরিমাণঃ </label>
                    <span>....................................................</span>
                </div>

                <div class="single-item">
                    <label>বিনিয়োগ প্রদানের তারিখঃ </label>
                    <span>...........................................</span>
                </div>

                <div class="single-item">
                    <label>বিনিয়োগ মেয়াদ উত্তীর্ণের তারিখঃ </label>
                    <span>...............................</span>
                </div>

                <div class="single-item">
                    <label>মন্তব্যঃ</label>
                    <span>.................................................................</span>
                </div>

            </div>

            <div>
                <h3>নমীনী তথ্য</h3>
                <div class="colums">
                    <div class="single-item">
                        <label>নমীনী নামঃ </label>
                        <span>.....................................................</span>
                    </div>
                    <div class="single-item">
                        <label>ইমেইলঃ</label>
                        <span>......................................................</span>
                    </div>
                     <div class="single-item">
                        <label>বর্তমান ঠিকানাঃ</label>
                        <span>................................................</span>
                    </div>
                    <div class="single-item">
                        <label>স্থায়ী ঠিকানাঃ</label>
                        <span>................................................</span>
                    </div>
                </div>
                <div>
                    <label>জাতীয় পরিচয় পত্রের নাম্বারঃ</label>
                    <span>................................................................................................................</span>
                </div>
                <br>
                <div class="colums">
                    <div class="single-item">
                        <label>আবেদনকারীর সাথে সম্পর্কঃ</label>
                        <span>.................................</span>
                    </div>
                    <div class="single-item">
                        <label>স্বাক্ষরঃ</label>
                        <span>........................................................</span>
                    </div>
                </div>
            </div>

            <div>
                <h3>গ্রেন্টার ১</h3>
                <div class="colums">
                    <div class="single-item">
                        <label>নমীনী নামঃ </label>
                        <span>...........................................................</span>
                    </div>
                    <div class="single-item">
                        <label>ফোনঃ </label>
                        <span>......................................................</span>
                    </div>
                     <div class="single-item">
                        <label>বর্তমান ঠিকানাঃ </label>
                        <span>......................................................</span>
                    </div>
                    <div class="single-item">
                        <label>স্বাক্ষরঃ</label>
                        <span>.....................................................</span>
                    </div>
                    <div class="single-item">
                        <label>জাতীয় পরিচয় পত্রের নাম্বারঃ</label>
                        <span>.......................................</span>
                    </div>
                </div>
            </div>

            <div>
                <h3>গ্রেন্টার ২</h3>
                <div class="colums">
                    <div class="single-item">
                        <label>নমীনী নামঃ </label>
                        <span>...........................................................</span>
                    </div>
                    <div class="single-item">
                        <label>ফোনঃ </label>
                        <span>......................................................</span>
                    </div>
                     <div class="single-item">
                        <label>বর্তমান ঠিকানাঃ </label>
                        <span>......................................................</span>
                    </div>
                    <div class="single-item">
                        <label>স্বাক্ষরঃ</label>
                        <span>.....................................................</span>
                    </div>
                    <div class="single-item">
                        <label>জাতীয় পরিচয় পত্রের নাম্বারঃ</label>
                        <span>.......................................</span>
                    </div>
                </div>
            </div>
          </form>
    </page>


</body>
</html>
