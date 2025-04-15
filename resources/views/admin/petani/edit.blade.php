@extends('layouting.guest.master')

@section('content')
    <div class="page-header">
        <div class="title">
            <h4>Petani</h4>
        </div>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('petani') }}">Petani</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
            <form>
                <div class="form-group">
                    <label>Text</label>
                    <input class="form-control" type="text" placeholder="Johnny Brown">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" value="bootstrap@example.com" type="email">
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input class="form-control" value="https://getbootstrap.com" type="url">
                </div>
                <div class="form-group">
                    <label>Telephone</label>
                    <input class="form-control" value="1-(111)-111-1111" type="tel">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" value="password" type="password">
                </div>
                <div class="form-group">
                    <label>Readonly input</label>
                    <input class="form-control" type="text" placeholder="Readonly input here…" readonly="">
                </div>
                <div class="form-group">
                    <label>Disabled input</label>
                    <input type="text" class="form-control" placeholder="Disabled input" disabled="">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <label class="weight-600">Custom Checkbox</label>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                <label class="custom-control-label" for="customCheck1-1">Check this custom checkbox</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck2-1">
                                <label class="custom-control-label" for="customCheck2-1">Check this custom checkbox</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck3-1">
                                <label class="custom-control-label" for="customCheck3-1">Check this custom checkbox</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-5">
                                <input type="checkbox" class="custom-control-input" id="customCheck4-1">
                                <label class="custom-control-label" for="customCheck4-1">Check this custom checkbox</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="weight-600">Custom Radio</label>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio4">Toggle this custom radio</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio5">Or toggle this other custom
                                    radio</label>
                            </div>
                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" id="customRadio6" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio6">Or toggle this other custom
                                    radio</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Disabled select menu</label>
                    <select class="form-control" disabled="">
                        <option>Disabled select</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>input plaintext</label>
                    <input type="text" readonly="" class="form-control-plaintext" value="email@example.com">
                </div>
                <div class="form-group">
                    <label>Textarea</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Help text</label>
                    <input type="text" class="form-control">
                    <small class="form-text text-muted">
                        Your password must be 8-20 characters long, contain letters and numbers, and must not contain
                        spaces,
                        special characters, or emoji.
                    </small>
                </div>
                <div class="form-group">
                    <label>Example file input</label>
                    <input type="file" class="form-control-file form-control height-auto">
                </div>
                <div class="form-group">
                    <label>Custom file input</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('petani') }}" class="btn btn-danger">Batal</a>
                    <button class="btn btn-success ml-2">Ubah</button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Hanya Test --}}