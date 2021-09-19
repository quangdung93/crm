<div class="comments">
    <div class="comments-box">
        <h3 class="title text-center">Bình Luận</h3>
        <h6 class="sub-title text-center">Hãy để lại bình luận của bạn</h6>
        <div class="frm-comment mt-4">
            <form id="comment-form" data-action="{{ route('comments.create') }}">
                <input type="hidden" name="commentable_id" value="{{ $model->id }}"/>
                <input type="hidden" name="commentable_type" value="{{ get_class($model) }}"/>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" name="name" autocomplete="off" class="form-control" placeholder="Nhập họ tên" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" autocomplete="off" class="form-control" placeholder="Nhập số điện thoại" required/>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="message" class="form-control" placeholder="Nhập bình luận" style="height:80px" required></textarea>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <button type="submit" class="btn bg-kangen">Gửi Bình Luận</button>
                </div>
            </form>
        </div>
    </div>
    @php
        $comments = $model->comments;
    @endphp
    @if($comments)
        <div class="comments-lists">
            @foreach($comments as $comment)
                <div class="item">
                    <div class="comment-name">
                        <span class="avatar">{{ mb_substr(strip_tags($comment->name), 0, 1); }}</span>
                        <span class="name">{{ strip_tags($comment->name) }}</span> <span class="time">{{ getAgoTime($comment->created_at) }}</span>
                    </div>
                    <div class="comment-content">{{ strip_tags($comment->message) }}</div>
                </div>
            @endforeach
        </div>
    @endif
</div>