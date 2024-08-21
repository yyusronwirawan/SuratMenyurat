@section('js')
<script>
    function submitForm() {
        document.getElementById('updateImgForm').submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
        var departmentSelect = document.getElementById('departmentName');
        var programStudiSelect = document.querySelector('.program-studi-select');

        // Fungsi untuk mengisi program studi
        function fillProgramStudi(departmentId, selectedProgramId) {
            programStudiSelect.innerHTML = '<option></option>';

            var link = "{{ route('openGetProgramStudi', ':departmentId') }}";
            link = link.replace(':departmentId', departmentId);

            fetch(link)
                .then(response => response.json())
                .then(data => {
                    data.forEach(program => {
                        var option = document.createElement('option');
                        option.value = program.id;
                        option.text = program.study_program_name;

                        // Tambahkan atribut 'selected' berdasarkan kondisi Laravel Blade
                        if ((selectedProgramId !== null) && (program.id == selectedProgramId)) {
                            option.setAttribute('selected', 'selected');
                        }

                        programStudiSelect.appendChild(option);
                    });
                });
        }

        // Event listener untuk perubahan pada departmentName
        departmentSelect.addEventListener('change', function() {
            var departmentId = this.value;

            if (departmentId) {
                // Dapatkan selectedProgramId dari old('study_program_id') atau $user->study_program_id
                var selectedProgramId =
                    "{{ old('study_program_id', isset($user) ? $user->study_program_id : null) }}";
                fillProgramStudi(departmentId, selectedProgramId);
            }
        });

        // Ambil option value saat pertama kali load
        var initialDepartmentId = departmentSelect.value;
        var initialSelectedProgramId =
            "{{ old('study_program_id', isset($user) ? $user->study_program_id : null) }}";
        if (initialDepartmentId) {
            fillProgramStudi(initialDepartmentId, initialSelectedProgramId);
        }
    });
</script>
@endsection