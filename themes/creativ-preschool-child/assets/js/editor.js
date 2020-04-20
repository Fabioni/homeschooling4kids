wp.domReady( () => {

  var cores = ["core/paragraph",
  "core/image",
  "core/heading",
  "core/gallery",
  "core/list",
  "core/quote",
  "core/audio",
  "core/cover",
  "core/file",
  "core/video",
  "core/preformatted",
  "core/code",
  "core/html",
  "core/button"]

  for (var i = 0; i < cores.length; i++){
    wp.blocks.registerBlockStyle( cores[i], [
      {
        name: 'default',
        label: 'Default',
        isDefault: true,
      },
      {
        name: 'h4k-großerPfeil',
        label: 'großer Pfeil von oben',
      }
    ]);
  }

  jQuery(document).on("click", ".h4k_dataKeysInput", function () {
    if (! jQuery(".h4k_dataKeysInput input").is("[list]")) {
      jQuery(".h4k_dataKeysInput input").attr("list", "h4k-dataKeys")
    }
  })
} );
