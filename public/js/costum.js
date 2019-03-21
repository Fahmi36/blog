  function pulsa() {
  	$.ajax({
  		url: '/beli/pulsa',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#pulsa").addClass('active');
  		$("#transfer").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function tranferpulsa() {
  	$.ajax({
  		url: '/transfer',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#transfer").addClass('active');
  		$("#dashboard").removeClass('active');
  		$("#pln").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function pln() {
  	$.ajax({
  		url: '/pln',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").addClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function history() {
  	$.ajax({
  		url: '/history',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").addClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function listharga() {
  	$.ajax({
  		url: '/listharga/pulsa',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listharga").addClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function listhargapln() {
  	$.ajax({
  		url: '/listharga/pln',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").addClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function listhargainet() {
  	$.ajax({
  		url: '/listharga/inet',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}
  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").addClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function setting() {
  	$.ajax({
  		url: '/setting',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#setting").addClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function deposit() {
  	$.ajax({
  		url: '/deposit',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#deposit").addClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function historypulsa() {
  	$.ajax({
  		url: '/history/pulsa',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#historypulsa").addClass('active');
  		$("#deposit").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function historypln() {
  	$.ajax({
  		url: '/history/pln',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#historypln").addClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
  		$("#konfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function konfirmasi(a) {
  	$.ajax({
  		url: '/konfirmasi/'+a,
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');

    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function cekkonfirmasi() {
  	$.ajax({
  		url: '/cekkonfirmasi',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").addClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function tambah_pembayaran() {
  	$.ajax({
  		url: '/tambah_pembayaran',
  		type: 'GET',
  		dataType: 'html',
  		beforeSend:function(){
  			$('#modal1').modal('show');
  		}

  	})
  	.done(function(data) {
  		$('#modal1').modal('hide');
  		$("#content").html(data);
  		$("#pln").removeClass('active');
  		$("#dashboard").removeClass('active');
  		$("#transfer").removeClass('active');
  		$("#pulsa").removeClass('active');
  		$("#historypln").removeClass('active');
  		$("#historypulsa").removeClass('active');
  		$("#deposit").removeClass('active');
  		$("#setting").removeClass('active');
  		$("#history").removeClass('active');
  		$("#listhargainet").removeClass('active');
  		$("#listharga").removeClass('active');
  		$("#listhargapln").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
      $("#tambah_pembayaran").addClass('active');
    })
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function gantihargapulsa() {
    $.ajax({
      url: '/gantihargapulsa',
      type: 'GET',
      dataType: 'html',
      beforeSend:function(){
        $('#modal1').modal('show');
      }

    })
    .done(function(data) {
      $('#modal1').modal('hide');
      $("#content").html(data);
      $("#pln").removeClass('active');
      $("#dashboard").removeClass('active');
      $("#transfer").removeClass('active');
      $("#pulsa").removeClass('active');
      $("#historypln").removeClass('active');
      $("#historypulsa").removeClass('active');
      $("#deposit").removeClass('active');
      $("#setting").removeClass('active');
      $("#history").removeClass('active');
      $("#listhargainet").removeClass('active');
      $("#listharga").removeClass('active');
      $("#listhargapln").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapln").removeClass('active');
      $("#gantihargapulsa").addClass('active');
    })
    .fail(function() {
      alert("error mohon refresh website");
    })

  }
  function gantihargapln() {
    $.ajax({
      url: '/gantihargapln',
      type: 'GET',
      dataType: 'html',
      beforeSend:function(){
        $('#modal1').modal('show');
      }

    })
    .done(function(data) {
      $('#modal1').modal('hide');
      $("#content").html(data);
      $("#pln").removeClass('active');
      $("#dashboard").removeClass('active');
      $("#transfer").removeClass('active');
      $("#pulsa").removeClass('active');
      $("#historypln").removeClass('active');
      $("#historypulsa").removeClass('active');
      $("#deposit").removeClass('active');
      $("#setting").removeClass('active');
      $("#history").removeClass('active');
      $("#listhargainet").removeClass('active');
      $("#listharga").removeClass('active');
      $("#listhargapln").removeClass('active');
      $("#cekkonfirmasi").removeClass('active');
      $("#tambah_pembayaran").removeClass('active');
      $("#gantihargapulsa").removeClass('active');
      $("#gantihargapln").addClass('active');
    })
    .fail(function() {
      alert("error mohon refresh website");
    })

  }
  function verify(a) {
  	$.ajaxSetup({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
  	});
  	$.ajax({
  		url: '/verifikasi/'+a,
  		type: 'POST',
  		beforeSend:function(){
  			confirm("Anda Yakin ?");
  		}
  	})
  	.done(function(data) {
  		if (data.sukses==true) {
  			$.notify({
  				icon: "notifications",
  				message: ""+data.message+""
  			}, {
  				type: 'success',
  				timer: 4000,
  				placement: {
  					from: 'top',
  					align: 'right'
  				}
  			});
  		}else{
  			$.notify({
  				icon: "notifications",
  				message: ""+data.message+""
  			}, {
  				type: 'danger',
  				timer: 4000,
  				placement: {
  					from: 'top',
  					align: 'right'
  				}
  			});
  		}
  		setTimeout(function(){
  			location.reload();
  		}, 5000);
  	})
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function delbank(a) {
  	$.ajaxSetup({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		}
  	});
  	$.ajax({
  		url: '/delbank/'+a,
  		type: 'POST',
  		beforeSend:function(){
  			confirm("Anda Yakin Delete Data Ini ?");
  		}
  	})
  	.done(function(data) {
  		setTimeout(function(){
  			location.reload();
  		}, 5000);
  	})
  	.fail(function() {
  		alert("error mohon refresh website");
  	})

  }
  function nomerhp()
  {
  	var input_data = $('#no_hp').val();
  	if (input_data.length === 0)
  	{
  		$('#pilih').attr('selected');
  	}
  	$.ajax({
  		type: "get", 
  		url: "/getpulsa",
  		data: {'cari': input_data},
  		success: function (data) {
                // return success
                if (data.length > 0) {
                	$('#selected').html(data);
                }
              }
            });

  }

  function tranferpulsahp()
  {
  	var input_data = $('#no_hp').val();
  	if (input_data.length === 0)
  	{
  		$('#pilih').attr('selected');
  	}
  	$.ajax({
  		type: "get", 
  		url: "/gettransfer",
  		data: {'cari': input_data},
  		success: function (data) {
                // return success
                if (data.length > 0) {
                	$('#selected').html(data);
                }
              }
            });

  }
