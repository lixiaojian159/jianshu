$.ajaxSetup({
	headers:{
		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	}
});

var editor = new wangEditor('content');
if(editor.config){
	editor.config.uploadImgUrl = '/posts/image/upload';

	// 设置 headers（举例）
	editor.config.uploadHeaders = {
	    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	};

	editor.create();
}

$('.like-button').click(function(event){

	var like_value = $('.like-button').attr('like-value');
	var like_user  = $('.like-button').attr('like-user');
	if(like_value == 1){
		$.ajax({
			url:'/user/'+like_user+'/fan',
			type:'POST',
			dataType:'json',
			success:function(data){
				if(data.error != 0){
					alert(data.mag);
				}
				$('.like-button').attr('like-value',0);
				$('.like-button').html('取消关注');
			}
		});
	}else{
		$.ajax({
			url:'/user/'+like_user+'/doUnFan',
			type:'POST',
			dataType:'json',
			success:function(data){
				if(data.error != 0){
					alert(data.msg);
				}
				$('.like-button').attr('like-value',1);
				$('.like-button').html('关注');
			}
		});
	}
});