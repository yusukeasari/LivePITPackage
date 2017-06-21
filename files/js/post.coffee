$(window).load ->
	$('#loadImage').hide()

	router = new Backbone.Router
	router.route "indi/:id/", (_id)=>
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
				# 処理
				if data.isOk
					$('#loadImage').
						attr('src',"collage/result/"+_id.slice(1)+".png?"+Math.floor(Math.random()*10000)).
						load( =>
							#
							$('#loadImage').show()
						).
						error( =>
							#
						)

	Backbone.history.start()

	$('#searchSubmitButton').bind 'click', =>
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
				if data.isOk
					$('#loadImage').
						attr('src',"collage/result/"+$('#SearchPanelInnerContents #id').val().slice(1)+".png?"+Math.floor(Math.random()*10000)).
						load( =>
							#
							$('#loadImage').show()
						).
						error( =>
							#
						)
