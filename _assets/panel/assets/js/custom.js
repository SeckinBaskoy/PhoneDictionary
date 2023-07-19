$(function(){ 

/* DATATABLE TOGGLE-SWITCHERRY  ÇÖZÜMÜ */

// Önceden tanımlanmış bir değişken ile Switchery öğelerini saklamak için bir dizi oluşturun
var switcheryArray = [];

// "draw.dt" etkinliği tetiklendiğinde çalışacak işlevi tanımlayın
$(".content-container").on('draw.dt', function() {
  // Her öğe için "data-switchery" özniteliğini kontrol edin
  $('[data-switchery]').each(function() {
    var $this = $(this);
    var color = $this.attr('data-color') || '#188ae2';
    var jackColor = $this.attr('data-jackColor') || '#ffffff';
    var size = $this.attr('data-size') || 'default';

    // Mevcut Switchery öğesi varsa güncelleyin, yoksa yeni bir öğe oluşturun ve diziye ekleyin
    var existingSwitchery = switcheryArray.find(function(item) {
      return item.element === this;
    }, this);
    if (existingSwitchery) {
      existingSwitchery.switchery.setColor(color);
      existingSwitchery.switchery.setSize(size);
      existingSwitchery.switchery.setJackColor(jackColor);
    } else {
      var switchery = new Switchery(this, {
        color: color,
        size: size,
        jackColor: jackColor
      });
      switcheryArray.push({
        element: this,
        switchery: switchery
      });
    }
  });
});



/*--------------------------------------*/


$(".remove-btn").click(function(e) {

	var $data_url=$(this).data("url");

	swal({
    title: 'Are you sure?',
    text: "You will not be able to undo this action!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText:'No',
    confirmButtonText: 'Yes, delete!'}).then((result) => {
      if (result.value) {
        window.location.href=$data_url;
        
        swal(
          'Deleted!',
          'Record deleted successfully.',
          'success'
        ).delay( 3000 )
        
      }}
    )
  }
)

$(".isActive").change(function(){

	var $data=$(this).prop("checked");
	var $data_url=$(this).data("url");

	if(typeof $data !== "undefined" && typeof $data_url !== "undefined") {
		
		$.post($data_url,{ data:$data }, function (response) {
      
		});
	}})

$(".sortable").sortable();

$(".sortable").on("sortupdate",function(event,ui){

	var $data=$(this).sortable("serialize");
	var $data_url=$(this).data("url");

	$.post($data_url,{ data:$data },function(response){

	})})

})
