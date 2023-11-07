// Initializing Filestack with API key
const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');
const imageInput = document.getElementById('image-url');

if (imageInput) {
    // Attaching an image upload event
    imageInput.addEventListener('click', () => {
        // Image uploading via Filestack
        client.picker({
            accept: 'image/*',
            onUploadDone: (file) => {
                // Get URL of uploaded image
                const imageUrl = file.url;
    
                // Set URL as "image_url" field value
                document.getElementById('image-url').value = imageUrl;
                console.log('URL завантаженого зображення:', imageUrl);
            }
        }).open();
    });
} else {
    console.log('Error');
}

// const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

// // const image = document.getElementById('imageElement');
// const fileInput = document.getElementById('filestack-picker');

// fileInput.addEventListener("click", (e) => {
//     const file = e.target.files[0];

//     client.upload(file).then((response) => {
//         console.log("URL завантаженого файлу:", response.url);
//         // image.src = response.url;
//     }).catch((error) => {
//         console.log(error);
//     });
// });