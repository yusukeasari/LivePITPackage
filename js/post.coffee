$(window).load ->
	$('#loadImage').hide()
	$('#snsButtons').hide()
	$('#qrImage').hide()

	router = new Backbone.Router
	router.route "indi/:id/", (_id)=>
		@hideSnsButton
		$("#Popup #loadImage").
		attr('src','')

		query = 'id='+_id

		$.ajax 'collage.php',
			type:"GET"
			data:query
			dataType:"json"
			error: (jqXHR, textStatus, errorThrown) =>
				# 処理
			success:(data) =>
				@showSnsButton
				setSnsButton(_id)
				setQrImage(_id)
				# 処理
				if data.isOk
					$('#loadImage').
						attr('src',"collage/result/"+_id.slice(1)+".png?"+Math.floor(Math.random()*10000)).
						load( =>
							#
							$('#loadImage').show()
							showSnsButton()
							$('#postId').text(_id)
						).
						error( =>
							#
						)

	Backbone.history.start()

	$('#searchSubmitButton').bind 'click', =>
		router.navigate "",
			trigger: true
		hideSnsButton
		hideQrImage
		$("#Popup #loadImage").
		attr('src','')

		query = 'id='+$('#SearchPanelInnerContents #id').val()
		$.ajax 'collage.php',
			type:"GET"
			data:query
			dataType:"json"
			error: (jqXHR, textStatus, errorThrown) =>
				# 処理
			success:(data) =>
				# 処理
				setQrImage($('#SearchPanelInnerContents #id').val())
				setSnsButton($('#SearchPanelInnerContents #id').val().slice(1))
				if data.isOk
					$('#loadImage').
						attr('src',"collage/result/"+$('#SearchPanelInnerContents #id').val().slice(1)+".png?"+Math.floor(Math.random()*10000)).
						load( =>
							#
							$('#loadImage').show()
							showSnsButton()
							$('#postId').text(_id)
						).
						error( =>
							#
						)

	hideSnsButton = =>
		$('#snsButtons').hide()
	showSnsButton = =>
		$('#snsButtons').show()
	setSnsButton = (_id)=>
		lineURL = "http://line.me/R/msg/text/?"+encodeURIComponent("http://livepit2.pitcom.jp/post.php#indi/#{_id}/")
		twitterURL = "https://twitter.com/intent/tweet?url="+encodeURIComponent("http://livepit2.pitcom.jp/post.php#indi/#{_id}/")
		fbURL = "https://www.facebook.com/sharer.php?u="+encodeURIComponent("http://livepit2.pitcom.jp/post.php#indi/#{_id}/")

		$('#snsLineButton').click( =>
			window.location.href = lineURL
		)
		$('#snsTwitterButton').click( =>
			window.location.href = twitterURL
		)
		$('#snsFacebookButton').click( =>
			window.location.href = fbURL
		)

	hideQrImage = =>
		$('#qrImage').hide()
		#
	showQrImage = =>
		$('#qrImage').show()
		#
	setQrImage = (_id)=>
			$('#qrImage').
				attr('src','lib/qr_img.php?d='+encodeURIComponent("http://live.pitcom.jp/post.php#indi/#{_id}/?utm_source=framecollage&utm_medium=qr&utm_campaign=#{_id}")+'&e=M&t=P&'+Math.floor(Math.random()*10000)).
				load( =>
					showQrImage()
				)
			#encodeURIComponent("http://live.pitcom.jp/post.php#indi/#{_id}/")+'&e=M&t=P'
