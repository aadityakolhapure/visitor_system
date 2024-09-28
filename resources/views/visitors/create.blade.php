<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for transitions */
        .form-input {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .btn {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #3b82f6;
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="bg-gray-100">

    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto ">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/login_logo.png') }}" class="h-10 " alt="Flowbite Logo"
                    style="height: 80px; width: 280px">
            </a>

            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse m-3">
                <a type="button" href="{{ route('home') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-4">Home</a>
                <a type="button" href="{{ route('visitor.checkout.form') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-4">Checkout</a>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul
                    class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <h2 class="text-4xl font-extrabold dark:text-white">Welcome To Dnyanshree</h2>
                </ul>
            </div>
        </div>
    </nav>

    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden md:max-w-2xl p-8 mt-16 fade-in m-4">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-700 m-4">Visitor Registration</h2>
        <!-- Error Alert -->
        <div id="error-alert"
            class="hidden p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <span class="font-medium">Danger alert!</span> Please capture a photo before registering.
        </div>
        <form method="POST" action="{{ route('visitor.store') }}" id="visitorForm">
            @csrf

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                </div>

                {{-- <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                    <input type="text" id="name" name="name" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                </div> --}}

                <div class="mb-4">
                    <label for="member_count" class="block text-gray-700 text-sm font-bold mb-2">Number of Additional
                        Members:</label>
                    <input type="number" id="member_count" name="member_count" min="0" max="3"
                        value="0" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                </div>

                <div id="member_names">
                    <div class="mb-4 hidden" id="member1_div">
                        <label for="member1" class="block text-gray-700 text-sm font-bold mb-2">Name of Member
                            1:</label>
                        <input type="text" id="member1" name="member1"
                            class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                    </div>
                    <div class="mb-4 hidden" id="member2_div">
                        <label for="member2" class="block text-gray-700 text-sm font-bold mb-2">Name of Member
                            2:</label>
                        <input type="text" id="member2" name="member2"
                            class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                    </div>
                    <div class="mb-4 hidden" id="member3_div">
                        <label for="member3" class="block text-gray-700 text-sm font-bold mb-2">Name of Member
                            3:</label>
                        <input type="text" id="member3" name="member3"
                            class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                    <input type="text" id="phone" name="phone" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                </div>

                <div class="mb-4">
                    <label for="department" class="block text-gray-700 text-sm font-bold mb-2">Department:</label>
                    <select id="department" name="department" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-4">
                    <label for="meet" class="block text-gray-700 text-sm font-bold mb-2">Whom to Meet:</label>
                    <select id="meet" name="meet" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none">
                        <option value="">Select Person</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="purpose" class="block text-gray-700 text-sm font-bold mb-2">Purpose of Visit:</label>
                    <textarea id="purpose" name="purpose" required
                        class="form-input shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none"></textarea>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Photo:</label>
                <div id="camera-container" class="mb-2">
                    <video id="video" class="border rounded" autoplay></video>
                </div>
                <button type="button" id="capture"
                    class="btn bg-green-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2">
                    Capture Photo
                </button>
                <canvas id="canvas" style="display:none;"></canvas>
                <input type="hidden" id="photo-data" name="photo">
            </div>

            <div class="flex items-center justify-center">
                <button type="submit"
                    class="btn bg-blue-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Register
                </button>
            </div>
        </form>

        <!-- Confirmation Message -->
        <div id="confirmation-message" class="hidden mt-4 text-center text-green-600 font-bold">
            Photo captured successfully!
        </div>
    </div>

    <!-- Photo Preview Modal -->
    <div id="photo-modal" class="fixed inset-0 bg-gray-600 bg-opacity-75 flex justify-center items-center hidden">
        <div class="bg-white rounded-lg p-4 max-w-sm w-full">
            <h2 class="text-lg font-bold mb-4">Preview Photo</h2>
            <img id="photo-preview" class="w-full h-auto border rounded mb-4" alt="Photo Preview">
            <div class="flex justify-between">
                <button id="retake" class="btn bg-red-500 text-white font-bold py-2 px-4 rounded">Retake</button>
                <button id="ok" class="btn bg-blue-500 text-white font-bold py-2 px-4 rounded">OK</button>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 shadow-lg py-4 mt-8">
        <div class="max-w-screen-xl mx-auto text-center">
            <span class="text-sm text-gray-500">© 2023 <a href="#" class="hover:underline">Your Company™</a>.
                All Rights Reserved.</span>
        </div>
    </footer>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photoPreview = document.getElementById('photo-preview');
        const captureButton = document.getElementById('capture');
        const photoModal = document.getElementById('photo-modal');
        const photoData = document.getElementById('photo-data');
        const retakeButton = document.getElementById('retake');
        const okButton = document.getElementById('ok');
        const confirmationMessage = document.getElementById('confirmation-message');
        const visitorForm = document.getElementById('visitorForm');
        const errorAlert = document.getElementById('error-alert');

        // Access the user's camera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                console.error("Error accessing the camera: ", err);
            });

        // Capture photo
        captureButton.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            const photoSrc = canvas.toDataURL('image/jpeg');
            photoPreview.src = photoSrc; // Show preview
            photoData.value = photoSrc; // Store base64 image data
            photoModal.classList.remove('hidden'); // Show modal
        });

        // Retake button
        retakeButton.addEventListener('click', () => {
            // Clear photo data to prevent saving the previous photo
            photoData.value = '';
            photoModal.classList.add('hidden'); // Hide modal
        });

        // OK button
        okButton.addEventListener('click', () => {
            photoModal.classList.add('hidden'); // Hide modal
            confirmationMessage.classList.remove('hidden'); // Show confirmation message
        });

        // Form submission
        visitorForm.addEventListener('submit', (event) => {
            if (!photoData.value) { // Check if photo is captured
                event.preventDefault(); // Prevent form submission
                errorAlert.classList.remove('hidden'); // Show error alert
            } else {
                errorAlert.classList.add('hidden'); // Hide error alert if photo is captured
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const memberCount = document.getElementById('member_count');
            const member1Div = document.getElementById('member1_div');
            const member2Div = document.getElementById('member2_div');
            const member3Div = document.getElementById('member3_div');
            const departmentSelect = document.getElementById('department');
            const meetSelect = document.getElementById('meet');

            departmentSelect.addEventListener('change', function() {
                const departmentId = this.value;
                if (departmentId) {
                    fetch(`/api/users-by-department/${departmentId}`)
                        .then(response => response.json())
                        .then(data => {
                            meetSelect.innerHTML = '<option value="">Select Person</option>';
                            data.forEach(user => {
                                const option = document.createElement('option');
                                option.value = user.id;
                                option.textContent = user.name;
                                meetSelect.appendChild(option);
                            });
                        });
                } else {
                    meetSelect.innerHTML = '<option value="">Select Person</option>';
                }
            });

            function updateMemberFields() {
                const count = parseInt(memberCount.value);

                if (count >= 1) {
                    member1Div.classList.remove('hidden');
                    member1Div.querySelector('input').required = true;
                } else {
                    member1Div.classList.add('hidden');
                    member1Div.querySelector('input').required = false;
                    member1Div.querySelector('input').value = '';
                }

                if (count >= 2) {
                    member2Div.classList.remove('hidden');
                    member2Div.querySelector('input').required = true;
                } else {
                    member2Div.classList.add('hidden');
                    member2Div.querySelector('input').required = false;
                    member2Div.querySelector('input').value = '';
                }

                if (count >= 3) {
                    member3Div.classList.remove('hidden');
                    member3Div.querySelector('input').required = true;
                } else {
                    member3Div.classList.add('hidden');
                    member3Div.querySelector('input').required = false;
                    member3Div.querySelector('input').value = '';
                }
            }

            memberCount.addEventListener('change', updateMemberFields);
            memberCount.addEventListener('input', updateMemberFields);

            // Call updateMemberFields initially to set the correct state
            updateMemberFields();

            document.getElementById('visitorForm').addEventListener('submit', function(e) {
                console.log('Form submitted');
                // Uncomment the next line to see form data in console
                // console.log(new FormData(this));
            });
        });
    </script>

</body>

</html>