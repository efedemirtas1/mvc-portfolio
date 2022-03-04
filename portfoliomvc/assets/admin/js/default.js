$(document).ready(function(){

    $( ".sortable" ).sortable();
    $(".content").on("click",".btn-delete",function(){

        var $data_url = $(this).data("url");
        
        Swal.fire({
            title: 'Silmek istediğinizden emin misiniz!',
            text: "Silme işlemi geri alınamaz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hayır',
            confirmButtonText: 'Evet, Sil!'
        }).then(function (result) {
            if (result.value) {
                window.location.href = $data_url;
            }
        })
        
    });
    $(".imageDelete").click(function(){

      var $data_url = $(this).data("url");
      
      Swal.fire({
          title: 'Silmek istediğinizden emin misiniz!',
          text: "Silme işlemi geri alınamaz!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Hayır',
          confirmButtonText: 'Evet, Sil!'
      }).then(function (result) {
          if (result.value) {
              window.location.href = $data_url;
          }
      })
      
    });

    $(".content").on("click",".dataActive",function(){
        
        var $data_checked = $(this).prop("checked");
        var $data_url = $(this).data("url");

        if(typeof $data_checked !== "undefined" && typeof $data_url !== "undefined"){
            
            $.post($data_url, { data_checked : $data_checked }, function(response){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                  })
                  //işlem sonucu alert
                if($data_checked == true){
                    Toast.fire({
                        icon : 'success',
                        title: 'Kayıt aktifleştirildi!'
                     })
                }else{
                    Toast.fire({
                        icon : 'warning',
                        title: 'Kayıt pasifleştirildi!'
                     })
                }

            });

        }
    })

    $( ".sortable" ).on("sortupdate", function(event, ui){
        
        var $data = $(this).sortable("serialize");
        var $data_url = $(this).data("url");

        $.post($data_url, { data : $data }, function(response){
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              })
              
              Toast.fire({
                icon: 'success',
                title: 'Sıralama başarıyla gerçekleşti.'
              })  
        });
    });

    $(function() {
        $(document).on("change",".uploadFile", function()
        {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function(){ // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                }
            }
        
        });
    });
    //Sayfa şablon seçimi
    $('#sablon').on('change',function(e){
		e.preventDefault();
		var result = $(this).val();
        if(result == 1){
            var img = '<img src="assets/admin/images/sablon1.jpg" alt="">' 
        }
        else if(result == 2){
            var img = '<img src="assets/admin/images/sablon2.jpg" alt="">' 
        }
        else if(result == 3){
            var img = '<img src="assets/admin/images/sablon3.jpg" alt="">' 
        }
		$('#sonuc').html(img);
	});

});

//Başlıktan seo link oluşturma
$('#title').keyup(function(){
    var deger=$('#title').val();
    mesajTemizle(deger);
});
$('#mesaj').keydown(function(){
    var deger=$('#mesaj').val();
    mesajTemizle(deger);
});


function mesajTemizle(deger){
    var karakterler = {Ç:'c',Ö:'o',Ş:'s',İ:'i',I:'i',Ü:'u',Ğ:'g',ç:'c',ö:'o',ş:'s',ı:'i',ü:'u',ğ:'g'};

    var stringtoarray = deger.split('');

    for( var i=0; i<stringtoarray.length; i++ ) {
        stringtoarray[i] = karakterler[ stringtoarray[i] ] || stringtoarray[i];
    }

    var arraytostring = stringtoarray.join('');
    var temiz_mesaj = arraytostring.replace(" ","-").replace("--","-").toLowerCase();

    $('#seoUrl').val(temiz_mesaj);
}
//Başlıktan seo link oluşturma


var clicked = false;
$("#checkallread").on("click", function() {
    $(".checkhourread").prop("checked", !clicked);
    clicked = !clicked;
    this.innerHTML = clicked ? 'Kapat' : 'Aç';
});

function kopyala(element) {
    var $temp = $("<input>")
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      
      Toast.fire({
        icon: 'success',
        title: 'Kopyalandı'
      })
};