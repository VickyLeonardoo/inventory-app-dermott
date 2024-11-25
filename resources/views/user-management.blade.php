<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-3xl font-bold text-blue-800">Manajemen Pengguna</h3>
                        <button id="createUserButton" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out flex items-center shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Tambah Pengguna
                        </button>
                    </div>

                    <div class="mb-4 flex">
                        <input type="text" id="emailSearch" placeholder="Cari berdasarkan email" class="flex-grow px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button id="searchButton" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition duration-300">Cari</button>
                    </div>

                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                            <thead>
                                <tr class="text-left">
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Nama</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Email</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">No HP</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Role</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Status</th>
                                    <th class="bg-blue-100 sticky top-0 border-b border-gray-200 px-6 py-3 text-blue-700 font-bold tracking-wider uppercase text-xs">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="userTableBody">
                                <!-- Table body will be populated dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div id="userModal" class="hidden fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Tambah Pengguna</h3>
                            <div class="mt-2">
                                <form id="userForm" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="_method" id="formMethod" value="POST">
                                    <input type="hidden" name="id" id="userId">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                                        <input type="text" name="name" id="name" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="password" name="password" id="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div>
                                        <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 sm:text-sm">
                                                62
                                            </span>
                                            <input type="text" name="no_hp" id="no_hp" class="pl-8 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required pattern="[0-9]*">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                        <select name="role" id="role" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                            <option value="">Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="karyawan">Karyawan</option>
                                        </select>
                                    </div>
                                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                                            Simpan
                                        </button>
                                        <button type="button" id="closeModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm transition duration-300">
                                            Batal
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateUserTable(users) {
            const tableBody = document.getElementById('userTableBody');
            tableBody.innerHTML = '';
            
            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">${user.name}</td>
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">${user.email}</td>
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">${user.no_hp}</td>
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${user.role === 'admin' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800'}">
                            ${user.role.charAt(0).toUpperCase() + user.role.slice(1)}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${user.is_online ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                            ${user.is_online ? 'Online' : 'Offline'}
                        </span>
                    </td>
                    <td class="border-dashed border-t border-gray-200 px-6 py-4">
                        <button class="editButton text-blue-500 hover:text-blue-600 mr-3" data-id="${user.id}">Edit</button>
                        <button class="deleteButton text-red-500 hover:text-red-600" data-id="${user.id}">Hapus</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            attachEventListeners();
        }

        function fetchUsers(searchTerm = '') {
            fetch(`/get-users?search=${searchTerm}`)
                .then(response => response.json())
                .then(data => {
                    updateUserTable(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil data pengguna. Silakan coba lagi.');
                });
        }

        function attachEventListeners() {
            document.querySelectorAll('.editButton').forEach(button => {
                button.addEventListener('click', function() {
                    let userId = this.getAttribute('data-id');
                    fetch(`/user-management/${userId}/edit`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success && data.data) {
                                document.getElementById('modalTitle').innerText = 'Edit Pengguna';
                                document.getElementById('formMethod').value = 'PUT';
                                document.getElementById('userId').value = data.data.id;
                                document.getElementById('name').value = data.data.name;
                                document.getElementById('email').value = data.data.email;
                                document.getElementById('no_hp').value = data.data.no_hp.toString().replace(/^62/, '');
                                document.getElementById('role').value = data.data.role;
                                document.getElementById('password').required = false;
                                document.getElementById('userModal').classList.remove('hidden');
                            } else {
                                alert(data.message || 'Terjadi kesalahan saat mengambil data pengguna.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengambil data pengguna. Silakan coba lagi.');
                        });
                });
            });

            document.querySelectorAll('.deleteButton').forEach(button => {
                button.addEventListener('click', function() {
                    if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                        let userId = this.getAttribute('data-id');
                        fetch(`/user-management/${userId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                fetchUsers();
                                alert(data.message);
                            } else {
                                alert('Gagal menghapus pengguna: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menghapus pengguna. Silakan coba lagi.');
                        });
                    }
                });
            });
        }

        document.getElementById('createUserButton').addEventListener('click', function() {
            document.getElementById('userForm').reset();
            document.getElementById('modalTitle').innerText = 'Tambah Pengguna';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('userId').value = '';
            document.getElementById('password').required = true;
            document.getElementById('userModal').classList.remove('hidden');
        });

        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('userModal').classList.add('hidden');
        });

        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const method = document.getElementById('formMethod').value;
            const userId = document.getElementById('userId').value;
            const url = method === 'PUT' 
                ? `/user-management/${userId}`
                : '/user-management';

            if (method === 'PUT') {
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('userModal').classList.add('hidden');
                    fetchUsers();
                    alert(data.message);
                } else {
                    let errorMessage = 'Terjadi kesalahan:\n';
                    if (data.errors) {
                        for (let field in data.errors) {
                            errorMessage += `${field}: ${data.errors[field].join(', ')}\n`;
                        }
                    } else {
                        errorMessage += data.message || 'Unknown error';
                    }
                    alert(errorMessage);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        });

        document.getElementById('searchButton').addEventListener('click', function() {
            const searchTerm = document.getElementById('emailSearch').value;
            fetchUsers(searchTerm);
        });

        document.getElementById('emailSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('searchButton').click();
            }
        });

        document.addEventListener('DOMContentLoaded', () => fetchUsers());
        setInterval(() => fetchUsers(document.getElementById('emailSearch').value), 5000);
    </script>
</x-app-layout>