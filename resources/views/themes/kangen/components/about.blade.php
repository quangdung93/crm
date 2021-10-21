<section class="section-contact">
    <div class="container">
        <div class="section-title text-left">
            <h3><a href="#">TẠI SAO CHỌN CHÚNG TÔI?</a></h3>
            <p>Chúng tôi tự hào là nhà phân phối Ủy Quyền của công ty Kangen Việt Nam.</p>
        </div>
        <div class="content">
            @php
                $section12 = theme('home_section_12');
            @endphp
            <div class="row">
                <div class="col-sm-8">
                    @foreach(array_chunk($section12, 2) as $value)
                        <div class="contact-home-block">
                            @foreach($value as $item)
                                <div class="item">
                                    <div class="image">
                                        <img class="img-fuild lazy" data-src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" />
                                    </div>
                                    <div class="info">
                                        <p>{{ $item['title'] }}</p>
                                        <p>{{ $item['content'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="col-sm-4">
                    <div class="contact-form">
                        <div class="frm-title">Yêu Cầu Gọi Lại</div>
                        <form class="frm-register" data-action="{{ route('register.form') }}" method="POST">
                            <div class="form-group">
                                <input type="text" name="name" value="" class="form-control" placeholder="Họ và tên" required/>
                                <input type="hidden" name="type" value="recall"/>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" value="" class="form-control" placeholder="Số điện thoại" required/>
                            </div>
                            <div class="form-group">
                                <textarea name="note" placeholder="Lời nhắn" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn read-more mt-4">Gửi Yêu Cầu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>