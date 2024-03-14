import Dropzone from "dropzone";
Dropzone.autoDiscover = false;

//creamos una instancia de dropzone, toma el id anterior
const dropzone = new Dropzone('#dropzone', {
    //configuracion extra
    dictDefaultMessage:"sube  aqui tu imagen",//msg
    acceptedFiles: '.png,.jpg,.jpeg,.git',//accepta
    addRemoveLinks: true,//permite al usuario eliminar su imagen
    dictRemoveFile: 'Borrar Archivo',//
    maxFiles: 1,
    uploadMultiple:false,


    init: function(){
      if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada ={};
            imagenPublicada.size=1234;//tamaño aqui no importa muicho. es un valor que requieres pero no es obloatorio
            imagenPublicada.name=document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada)//call se asigna pero se manda a llamar
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${ imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add(
               "dz-success",
               "dz-complete"
               );
      }
    }

});
dropzone.on('sending', function(file, xhr, formData){
   console.log(file)
})

//cuando carga correctamente
dropzone.on('success', function(file, response){
   //console.log(response.imagen)
   document.querySelector('[name="imagen"]').value= response.imagen
})
//cuando hay un error
dropzone.on('error', function(file, message){
    console.log(message)
 })
 //eliminar el archi

 //eliminar

 dropzone.on('removedfile', function(){
   document.querySelector('[name="imagen"]').value= "";
 })


