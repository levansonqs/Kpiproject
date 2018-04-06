<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Lobster+Two' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand brand" href="#"><span class="glyphicon glyphicon-list-alt"></span>Kproject</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('login')}}">Đăng nhập</a></li>
                    <li> <a href="{{route('register')}}"> Đăng kí </a> </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>
    <div class="content_1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1>Chào mừng đến với Kproject</h1>
                    <h1>Đăng nhập vào Kproject</h1>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h2><a href="{{route('login')}}" type="button" class="btn btn-primary btn-lg btn-block" name="button">Đăng nhập</a></h2><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content_2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="col-md-7">
                            <h3>Kproject sẽ không làm rối bạn với những tính năng bạn không muốn sử dụng. Cho những ai muốn thêm nhiều thứ ngoài những cái bảng, có nhiều Power-Ups như Lịch, Thẻ cũ, và Bình chọn, và bạn có thể bật chúng lên. Nó sẽ giúp bạn được nhiều hơn mà không làm rối mọi thứ lên.</h3>
                        </div>
                        <div class="col-md-5">
                            <img src="Images/home-power-up-icons.png" class="img-responsive" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content_3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1> <span class="glyphicon glyphicon-list-alt"></span>Kproject</h1>
                    <h2> Kproject miễn phí, linh hoạt, và là cách trực quan để tổ chức mọi thứ với bất cứ ai. </h2>
                    <h4>Bỏ đi những email dài dòng, bảng tính đã cũ, ghi chú sắp hết thời gian hiện, và phần mềm ít sử dụng để quản lý các dự án của bạn. Kproject giúp bạn quan sát nhanh mọi thứ về dự án của bạn</h4>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <h3><a href="{{route('register')}}" type="button" class="btn btn-info btn-lg btn-block" name="button">Đăng kí</a></h3><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content_4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <h4>Chúng tôi có hàng ngàn người tin tưởng và tin dùng ở bất kì lĩnh vực nào.</h4>
                </div>
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="content_5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="link_footer">
                        <ul>
                            <li><a href="#">Tham quan</a></li>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Ứng dụng</a></li>
                            <li><a href="#">Nghề nghiệp</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Nhà phát triển</a></li>
                            <li><a href="#">Trợ giúp</a></li>
                        </ul>
                    </div>
                    <h3><span class="glyphicon glyphicon-list-alt"></span>Kproject 	&#169; Bản quyền 2018 bảo lưu toàn quyền</h3>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.js"integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
