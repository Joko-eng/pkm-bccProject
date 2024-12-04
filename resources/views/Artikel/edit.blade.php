<x-app-layout>
    <x-layout>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-3 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('Artikel.index')}}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        Artikel
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Edit Artikel</a>
                    </div>
                </li>
            </ol>
        </nav>
        <h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('Artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="judul" class="block text-gray-700">Judul:</label>
                <input type="text" id="judul" name="judul" value="{{ $artikel->judul }}"
                    class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="konten" class="block text-gray-700">Konten:</label>
                <textarea name="konten" id="summernote"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">{{ $artikel->konten }}</textarea>
            </div>
            <div class="w-full" style="display: none;">
                <label for="tgl_published" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Publish</label>
                <input type="hidden" name="tgl_published" id="tgl_published"
                    value="{{ old('tgl_published', $artikel->tgl_published) }}">
            </div>
            <div class="mb-4">
                <label for="gambar" class="block text-gray-700">Gambar:</label>
                <input type="file" id="gambar" name="gambar"
                    class="appearance-none border rounded w-full mb-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Artikel Image" class="mt-2 w-[300px]" width="450" height="450">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Memperbarui
                    Artikel</button>
            </div>
        </form>
          <script>
            const summerNoteInit = () => {
                $('#summernote').summernote({
                    lang: 'en-US',
                    imageAttributes: {
                        icon: '<i class="note-icon-pencil"/>',
                        removeEmpty: false, // true = remove attributes | false = leave empty if present
                        disableUpload: false // true = don't display Upload Options | Display Upload Options
                    },
                    popover: {
                        image: [
                            ['custom', ['imageAttributes']],
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']]
                        ],
                    },
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video', 'hr', 'grid']],
                        ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
                    ],
                    grid: {
                        wrapper: "row",
                        columns: [
                            "col-md-12",
                            "col-md-6",
                            "col-md-4",
                            "col-md-3",
                            "col-md-24",
                        ]
                    },
                    callbacks: {
                        onImageUpload: function (image) {
                            sendFile(image[0]);
                        },
                        onMediaDelete: function (target) {
                            deleteFile(target[0].src);
                        }
                    },
                    icons: {
                        grid: "bi bi-grid-3x2"
                    },
                });
            }
        </script>
        <script>
            $(document).ready(function () {
                // $('#summernote').summernote();
                summerNoteInit();
            });
            function sendFile(file, editor, welEditable) {
                token = "{{ csrf_token() }}"
                data = new FormData();
                data.append("file", file);
                data.append('_token', token);
                $('#loading-image-summernote').show();
                $('#summernote').summernote('disable');
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{ url('summernote/storage/upload/artikel') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (url) {
                        console.log(url);
                        if (url['status'] == "success") {
                            $('#summernote').summernote('enable');
                            $('#loading-image-summernote').hide();
                            $('#summernote').summernote('editor.saveRange');
                            $('#summernote').summernote('editor.restoreRange');
                            $('#summernote').summernote('editor.focus');
                            $('#summernote').summernote('editor.insertImage', url['image_url']);
                        }
                        $("img").addClass("img-fluid");
                    },
                    error: function (data) {
                        console.log(data)
                        $('#summernote').summernote('enable');
                        $('#loading-image-summernote').hide();
                    }
                });
            }
            function deleteFile(target) {
                token = "{{ csrf_token() }}"
                data = new FormData();
                data.append("target", target);
                data.append('_token', token);
                $('#loading-image-summernote').show();
                $('.summernote').summernote('disable');
                $.ajax({
                    data: data,
                    type: "POST",
                    url: "{{ url('summernote/picture/delete/article') }}",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        console.log(result)
                        if (result['status'] == "success") {
                            $('.summernote').summernote('enable');
                            $('#loading-image-summernote').hide();
                        }
                    },
                    error: function (data) {
                        console.log(data)
                        $('.summernote').summernote('enable');
                        $('#loading-image-summernote').hide();
                    }
                });
            }
        </script>
    </x-layout>
</x-app-layout>
