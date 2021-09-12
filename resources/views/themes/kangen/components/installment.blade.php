<div class="installment">
    <div class="title text-center">
        <h4>ĐĂNG KÝ TRẢ GÓP LÃI SUẤT 0%</h4>
        <p>Bạn không tốn bất kỳ chi phí phát sinh nào khác</p>
    </div>
    <div class="content row">
            <div class="col-sm-6 align-self-center">
                <div class="frm-kangen">
                    <div class="title text-center">ĐĂNG KÝ TRẢ GÓP</div>
                    <div class="content"> 
                        <div class="frm-footer-contact">
                            <form class="frm-register" data-action="{{ route('register.form') }}" method="POST">
                                <div class="form-group">
                                    <input type="text" name="phone" value="" class="form-control" placeholder="Số điện thoại" required/>
                                    <input type="hidden" name="type" value="installment"/>
                                </div>
                                <div class="form-group">
                                    <textarea name="note" placeholder="Lời nhắn" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn read-more mt-4">Đăng Ký</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="image-block">
                    <a href="#"><img class="img-fluid lazy" data-src="{{ asset('themes/kangen/images/chinh-sach-kangen.jpg') }}" alt="" /></a>
                </div>
            </div>
        </div>
</div>