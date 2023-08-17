@extends('layouts.admin.master')

@section('konten')
    <x-admin.page-heading>{{ $title }}</x-admin.page-heading>

    <!-- Content Row -->

    <div class="row">


        <div class="col-xl-12 col-lg-6">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Data {{ $title }}</h6>
                </div>
                <div class="card-body">
                    <p>Lihat contoh carousel <a href="http://">disini</a> | Carousel maks 5 gambar & min 3 gambar untuk hasil
                        terbaik.</p>
                    <a href="" class="btn btn-md btn-primary mb-3" data-toggle="modal" data-target="#modalCarousel"><i
                            class="fas fa-fw fa-plus"></i> Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Gambar</th>
                                    <th>Slide Title</th>
                                    <th>Slide Sub-Title</th>
                                    <th>Deskripsi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{ url('assets/images/clients/client1.png') }}" alt=""
                                            srcset=""></td>
                                    <td>Lorem, ipsum dolor.</td>
                                    <td>Lorem, ipsum.</td>
                                    <td>Lorem ipsum dolor sit amet.</td>
                                    <td>
                                        <a href="" class="btn btn-md btn-info"><i class="fas fa-fw fa-edit"></i>
                                            Edit</a>
                                        <a href="" class="btn btn-md btn-danger"><i
                                                class="fas fa-fw fa-trash-alt"></i> Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal Carousel -->
    <div class="modal fade" id="modalCarousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data {{ $title }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formCarousel" method="post">
                        <div class="mb-3">
                            <label for="gambar_service" class="form-label">Gambar Carousel</label>
                            <img id="preview-image" alt="" srcset="">
                            <input type="file" class="form-control" name="gambar_service" id="gambar_service">
                            <span class="text-danger" id="image-input-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="slide_title" class="form-label">Slide Title</label>
                            <input type="text" class="form-control" name="slide_title" id="slide_title"
                                placeholder="cth: Desain Arsitektur">
                        </div>
                        <div class="mb-3">
                            <label for="slide_subtitle" class="form-label">Slide Sub-Title</label>
                            <input type="text" class="form-control" name="slide_subtitle" id="slide_subtitle"
                                placeholder="cth: Desain Arsitektur">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                        </div>
                        <button class="btn btn-md btn-primary" id="btnService"><i
                                class="fas fa-fw fa-save"></i>Simpan</button>
                        <button class="btn btn-md btn-secondary" type="reset"><i
                                class="fas fa-fw fa-undo"></i>Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
