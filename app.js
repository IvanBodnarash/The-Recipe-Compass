// document.addEventListener('DOMContentLoaded', function () {
//     const client = filestack.init('AwxQNt5QZCr9LcJtnxGBQz');

//     document.getElementById('upload-button').addEventListener('clcik', function () {
//         client.pick({
//             accept: 'image/*',
//             maxFiles: 1,
//             transformations: {
//                 crop: {
//                     aspectRatio: 1
//                 }
//             }
//         }).then(function (response) {
//             const image_url = response.filesUploaded[0].url;
//             document.getElementById('image-url').value = image_url;
//         }).catch(function (error) {
//             console.error('Image upload error:', error);
//         });
//     });

//     document.getElementById('image')
// });