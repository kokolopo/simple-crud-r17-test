<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>R17</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>
        </div>
        @endif

        <div class="container mt-5">
            <label for="basic-url" class="form-label">Your vanity URL</label>
            <form class="input-group mb-3" action="/users" method="post">
                @csrf
                <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                <input type="text" name="url" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Enter</button>
            </form>

            <div class="d-flex justify-content-between">
                <h1>Tabel User</h1>
                <div class="d-flex align-content-end flex-wrap">
                    @if ($totalData === 0)
                    <button disabled class="btn btn-info text-light" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>
                        
                    @else
                    <button class="btn btn-info text-light" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button> 
                    @endif
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $index => $user)
                    <tr>
                        <th><strong>{{$index+1}}</strong></th>
                        <td>{{$user['nama']}}</td>
                        <td>{{$user['jabatan']}}</td>
                        <td>{{$user['jenis_kelamin']}}</td>
                        <td>{{$user['alamat']}}</td>
                        <td>
                            <div class="d-grid gap-2 d-md-block">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('delete_user', $user->id) }}" method="POST">
                                    <button data-id="{{$user->id}}" class="btn-edit btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalEdit-{{$user->id}}">Edit</button>
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- Modal Edit --}}
                    <div class="modal fade" id="modalEdit-{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('update_user', $user->id) }}" method="post">
                                        @method('put')
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input type="text" name="nama" value="{{$user->nama}}" class="form-control" id="inputText1" placeholder="Nama" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="jabatan" value="{{$user->jabatan}}" class="form-control" id="inputNumber1" placeholder="Jabatan" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="jenis_kelamin" value="{{$user->jenis_kelamin}}" class="form-control" id="inputNumber2" placeholder="Jenis Kelamin" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="alamat" value="{{$user->alamat}}" class="form-control" id="inputText2" placeholder="Alamat" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer mt-3">
                                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach           
                </tbody>
            </table>
        </div>

        <!-- Modal Add-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                        <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/users" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col">
                                    <input type="text" name="nama" class="form-control" id="inputText1" placeholder="Nama" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="jabatan" class="form-control" id="inputNumber1" placeholder="Jabatan" required>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col">
                                    <input type="text" name="jenis_kelamin" class="form-control" id="inputNumber2" placeholder="Jenis" required>
                                </div> --}}
                                <div class="col">
                                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin" >
                                        <option selected>Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                      </select>
                                </div>
                                <div class="col">
                                    <input type="text" name="alamat" class="form-control" id="inputText2" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="modal-footer mt-3">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <nav class="container">
          {{ $users->links('pagination::bootstrap-5') }}
        </nav>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    </body>
</html>
