<x-layout>
    <x-slot name="title">
        Excel Upload System
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <h3>Phase 1</h3>
            <p>Generate an Excel File</p>
            <span class="text-sm">
                This generates an excel file.

                <p class="text-notice">
                    Note:
                    <ul>
                        <li>If attempt is to generate more than 100 users, the process is queued.</li>
                        <li>Run <code>php artisan queue:listen</code> in the terminal.</li>
                    </ul>
                </p>
            </span>

            <form action="{{ route('eus.generateExcelFile') }}" method="post" class="form">
                @csrf

                <input
                    type="number"
                    name="number_of_users"
                    placeholder="Number of users to generate"
                    class="border @error('title') is-invalid @enderror"
                    required
                >

                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="p-6">
            <h3>Phase 2</h3>
            <p>Download & Upload Excel File</p>
            <span class="text-sm">
                Export users for sample data and upload (generated from phase 1).

                <p class="text-notice">
                    Note:
                    <ul>
                        <li>
                            If file size is greater than {{ config('filesystems.max_file_size') }}KB,
                            import will move to a queue.
                        </li>
                        <li>Run <code>php artisan queue:listen</code> in the terminal</li>
                    </ul>
                </p>

                <form action="{{ route('uploadUsers') }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf

                    <input
                        type="file"
                        name="file"
                        accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                        required
                    >

                    <input type="submit" value="Submit">
                </form>
            </span>
        </div>
    </div>

    <x-return-home />
</x-layout>
