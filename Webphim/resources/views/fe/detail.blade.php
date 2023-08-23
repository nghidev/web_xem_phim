@extends('layouts.fe')

@section('content')
    <div class="container">
        <div class="row container" id="wrapper">
            <div class="halim-panel-filter">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="yoast_breadcrumb hidden-xs">
                                <span>
                                    <span>
                                        <a href="danhmuc.html">{{ $detail->category->title }}</a> »
                                        <a href="danhmuc.html">{{ $detail->country->title }}</a> »
                                        <a href="theloai.html">{{ $detail->genre->title }}</a> »
                                        <!-- Thêm dòng này -->
                                        <span class="breadcrumb_last" aria-current="page">{{ $detail->title }}</span>
                                    </span>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                    <div class="ajax"></div>
                </div>
            </div>
            <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">


                <section id="content" class="test">
                    <div class="clearfix wrap-content">

                        <div class="halim-movie-wrapper">
                            <div class="title-block">
                                <div id="bookmark" class="bookmark-img-animation primary_ribbon" data-id="38424">
                                    <div class="halim-pulse-ring"></div>
                                </div>
                                <div class="title-wrapper" style="font-weight: bold;">
                                    Bookmark
                                </div>
                            </div>
                            <div class="movie_info col-xs-12">
                                <div class="movie-poster col-md-3">
                                    <img class="movie-thumb" src="{{ asset('storage/images/' . $detail->image) }}"
                                        alt="GÓA PHỤ ĐEN">
                                    <div class="bwa-content">
                                        <div class="loader"></div>
                                        <a href="{{ route('watch', ['id' => $detail->id, 'slug' => $slugofepi->slug]) }}"
                                            class="bwac-btn">
                                            <i class="fa fa-play"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="film-poster col-md-9">
                                    <h1 class="movie-title title-1"
                                        style="display:block;line-height:35px;margin-bottom: -14px;color: #ffed4d;text-transform: uppercase;font-size: 18px;">
                                        {{ $detail->title }}</h1>
                                    <h2 class="movie-title title-2" style="font-size: 12px;">{{ $detail->title }}</h2>
                                    <ul class="list-info-group">
                                        <li class="list-info-group-item"><span>Trạng Thái</span> : <span
                                                class="quality">HD</span><span class="episode">Vietsub</span></li>
                                        <li class="list-info-group-item"><span>Điểm IMDb</span> : <span
                                                class="imdb">7.2</span></li>
                                        <li class="list-info-group-item"><span>Thời lượng</span> : 133 Phút</li>
                                        <li class="list-info-group-item"><span>Thể loại</span> : <a href=""
                                                rel="category tag">Chiếu Rạp</a>, <a href="" rel="category tag">Hành
                                                động</a>, <a href="" rel="category tag">Phiêu Lưu</a>, <a
                                                href="" rel="category tag">Viễn Tưởng</a></li>
                                        <li class="list-info-group-item"><span>Quốc gia</span> : <a href=""
                                                rel="tag">Mỹ</a></li>
                                        <li class="list-info-group-item"><span>Đạo diễn</span> : <a class="director"
                                                rel="nofollow" href="https://phimhay.co/dao-dien/cate-shortland"
                                                title="Cate Shortland">Cate Shortland</a></li>
                                        <li class="list-info-group-item last-item"
                                            style="-overflow: hidden;-display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-flex: 1;-webkit-box-orient: vertical;">
                                            <span>Diễn viên</span> : <a href="" rel="nofollow"
                                                title="C.C. Smiff">C.C. Smiff</a>, <a href="" rel="nofollow"
                                                title="David Harbour">David Harbour</a>, <a href="" rel="nofollow"
                                                title="Erin Jameson">Erin Jameson</a>, <a href="" rel="nofollow"
                                                title="Ever Anderson">Ever Anderson</a>, <a href="" rel="nofollow"
                                                title="Florence Pugh">Florence Pugh</a>, <a href="" rel="nofollow"
                                                title="Lewis Young">Lewis Young</a>, <a href="" rel="nofollow"
                                                title="Liani Samuel">Liani Samuel</a>, <a href="" rel="nofollow"
                                                title="Michelle Lee">Michelle Lee</a>, <a href="" rel="nofollow"
                                                title="Nanna Blondell">Nanna Blondell</a>, <a href="" rel="nofollow"
                                                title="O-T Fagbenle">O-T Fagbenle</a>
                                        </li>
                                    </ul>
                                    <div class="movie-trailer hidden"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="halim_trailer"></div>
                        <div class="clearfix"></div>
                        <div class="section-bar clearfix">
                            <h2 class="section-title"><span style="color:#ffed4d">Nội dung phim</span></h2>
                        </div>
                        <div class="entry-content htmlwrap clearfix">
                            <div class="video-item halim-entry-box">
                                <article id="post-38424" class="item-content">
                                    <p>{{ $detail->description }}</p>
                                    {{-- Phim <a href="https://phimhay.co/goa-phu-den-38424/">GÓA PHỤ ĐEN</a> - 2021 - Mỹ:
                                    <p>Góa Phụ Đen – Black Widow 2021: Natasha Romanoff hay còn gọi là Góa phụ đen phải đối
                                        mặt với những phần đen tối của mình khi một âm mưu nguy hiểm liên quan đến quá khứ
                                        của cô nảy sinh. Bị truy đuổi bởi một thế lực sẽ không có gì có thể hạ gục cô,
                                        Natasha phải đối mặt với lịch sử là một điệp viên những mối quan hệ tan vỡ đã để lại
                                        trong cô từ lâu trước khi cô trở thành thành viên của biệt đội Avenger.</p> --}}
                                    {{-- <h5>Từ Khoá Tìm Kiếm:</h5>
                                    <ul>
                                        <li>black widow vietsub</li>
                                        <li>Black Widow 2021 Vietsub</li>
                                        <li>phim black windows 2021</li>
                                        <li>xem phim black windows</li>
                                        <li>xem phim black widow</li>
                                        <li>phim black windows</li>
                                        <li>goa phu den</li>
                                        <li>xem phim black window</li>
                                        <li>phim black widow 2021</li>
                                        <li>xem black widow</li>
                                    </ul> --}}
                                </article>
                            </div>
                        </div>
                    </div>
                </section>


                <section id="halim-advanced-widget-2">
                    <div class="section-heading">
                        <a href="danhmuc.html" title="Phim Lẻ">
                            <span class="h-text">Có thể bạn muốn xem</span>
                        </a>
                    </div>
                    <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                        @php
                            $temp = $detail->genre->movie;
                        @endphp
                        @foreach ($temp as $item)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                              <div class="halim-item">
                                 <a class="halim-thumb" href="{{ route('detail', ['id' => $item->id, 'slug' => $item->slug]) }}" title="{{ $item->title }}">
 
                                     <figure>
                                         <img class="lazy img-responsive" src="{{ asset('storage/images/' . $item->image) }}"
                                             alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN">
                                     </figure>
                                     <span class="status">HD</span>
                                     <span class="episode"><i class="fa fa-play" aria-hidden="true"></i>Vietsub</span>
                                     <div class="icon_overlay"></div>
                                     <div class="halim-post-title-box">
                                         <div class="halim-post-title">
                                             <p class="entry-title">{{ $item->title }}</p>
                                             {{-- <p class="original_title">Black Widow</p> --}}
                                         </div>
                                     </div>
                                 </a>
                             </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            </main>
            <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4"></aside>
        </div>
    </div>
@endsection
