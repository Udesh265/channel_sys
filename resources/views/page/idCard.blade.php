<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card</title>
    <style>
        * {
            margin: 00px;
            padding: 00px;
            box-sizing: content-box;
        }

        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e6ebe0;
            flex-direction: row;
            flex-flow: wrap;


        }

        .font {
            height: 375px;
            width: 250px;
            position: relative;
            border-radius: 10px;
        }

        .top {
            height: 30%;
            width: 100%;
            position: relative;
            z-index: 5;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background-color: #fc036f;
        }

        .bottom {
            height: 70%;
            width: 100%;
            background-color: white;
            position: absolute;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }

        .top img {
            height: 100px;
            width: 100px;
            background-color: #e6ebe0;
            border-radius: 10px;
            position: absolute;
            top: 60px;
            left: 75px;
        }

        .bottom p {
            position: relative;
            top: 60px;
            text-align: center;
            text-transform: capitalize;
            font-weight: bold;
            font-size: 20px;
            text-emphasis: spacing;
        }

        .bottom .desi {
            font-size: 12px;
            color: #fc036f;
            font-weight: normal;
        }

        .bottom .no {
            font-size: 12px;
            font-weight: normal;
            margin-bottom: 2px;
        }

        .bottom .contact {
            font-size: 8px;
            font-weight: normal;
        }

        .barcode img {
            height: 100px;
            width: 100px;
            text-align: center;
            margin: 5px;
        }

        .barcode {
            text-align: center;
            position: relative;
            top: 70px;
        }

        .back {
            height: 375px;
            width: 250px;
            border-radius: 10px;
            background-color: #01421f;

            /* background-color: #8338ec; */

        }

        .qr img {
            height: 100px;
            width: 100%;
            margin: 20px;
            background-color: white;
        }

        .Details {
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 25px;
        }


        .details-info {
            color: white;
            text-align: left;
            padding: 5px;
            line-height: 20px;
            font-size: 16px;
            text-align: center;
            margin-top: 20px;
            line-height: 22px;
        }

        .logo {
            height: 40px;
            width: 150px;
            padding: 30px;
        }

        .logo div svg {
            width: 200px;
        }

        .padding {
            padding-right: 20px;
        }

        @media screen and (max-width:400px) {
            .container {
                height: 130vh;
            }

            .container .front {
                margin-top: 50px;
            }
        }

        @media screen and (max-width:600px) {
            .container {
                height: 130vh;
            }

            .container .front {
                margin-top: 50px;
            }

        }

    </style>
</head>

<body>
    <div id="app" class="container">
        <div class="padding">
            <div class="font">
                <div class="top">
                    <img src="{{$employee->user->photo->path}}">
                </div>
                <div class="bottom">
                    <p>{{ $employee->first_name }}</p>
                    {{-- <p class="desi">{{ $employee->employee_category->name }}</p> --}}
                    <div class="barcode">
                        <vue-vcard style="width:100%; height:auto;"
                        first-name="{{$employee->first_name}}"
                        work-email="{{$employee->email}}"
                        work-phone="{{ $employee->mobile  }}"
                        >

                    </div>
                    <br>
                </div>
            </div>
        </div>
        <div class="back">
            <h1 class="Details">Information</h1>
            <hr class="hr">
            <div class="details-info">
                <p><b>Email : </b></p>
                <p>{{ $employee->email }}</p>
                <p><b>Mobile No: </b></p>
                <p>{{ $employee->mobile  }}</p>
            </div>
            <div class="logo">
                <vue-barcode width="3" value="{{ $employee->barcode }}" format="CODE39" />
            </div>


            <hr>
        </div>
    </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
</body>

</html>
