Dropzone.options.myDropzone = {
    chunking: true, // Enable chunking
    forceChunking: true, // Force the chunks to be sent to the server
    chunkSize: 2000000, // Chunk size in bytes (e.g., 2MB)
    parallelChunkUploads: true, // Upload multiple chunks in parallel
    retryChunks: true, // Retry chunks on failure
    maxFilesize: 2500,
    acceptedFiles: ".mp4,.ogg",
    // Customize the success message
    success: function (file, response) {
      console.log(response.path);
      $(function() {
        $("#video").val(response.path);
      })
      alert("File successfully uploaded!")
    },

    // Customize the error message
    error: function (file, errorMessage) {
      alert(errorMessage);
    }
};