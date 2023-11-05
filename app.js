// Initializing Filestack with API key
// const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');
// const imageInput = document.getElementById('filestack-picker');

// // Attaching an image upload event
// imageInput.addEventListener('click', () => {
//     // Image uploading via Filestack
//     client.picker({
//         accept: 'image/*',
//         onUploadDone: (file) => {
//             // Get URL of uploaded image
//             const imageUrl = file.url;

//             // Set URL as "image_url" field value
//             // document.getElementById('image-url').value = imageUrl;
//             console.log('URL завантаженого зображення:', imageUrl);
//         }
//     }).open();
// });

const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

// const image = document.getElementById('imageElement');
const fileInput = document.getElementById('upload-button');

fileInput.addEventListener("click", (e) => {
    const file = e.target.files[0];

    client.upload(file).then((response) => {
        console.log("URL завантаженого файлу:", response.url);
        // image.src = response.url;
    }).catch((error) => {
        console.log(error);
    });
});