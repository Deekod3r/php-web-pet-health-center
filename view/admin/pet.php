<!doctype html>
<html lang="en">
<?php $title = "PET" ?>
<?php include("view/admin/layout/asset-header.php") ?>

<body>
    <?php include("view/admin/layout/header.php") ?>
    <div class="container-fluid main-admin">
        <div class="container">
            <form action="" style="margin-bottom: 40px" id="form-search-pet" method="get">
                <div class="row" style="margin-top: 10px">
                    <div class="form-group col-lg-5">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập tên thú cưng:</p>
                        <input type="text" class="form-control border-1" name="petName" id="pet-name" />
                    </div>
                    <div class="form-group col-lg-5">
                        <p style="font-weight:bold; margin-bottom:0; color:black">&nbspNhập số điện thoại chủ:</p>
                        <input type="text" class="form-control border-1" name="ctmPhone" id="ctm-phone" />
                    </div>
                    <div class="col-lg-3">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspDanh mục thú cưng:</p>
                        <select name="typePet" id="type-pet" class="custom-select" style="width:250px;">
                            <option value="">Tất cả</option>
                            <option value="0">Mèo</option>
                            <option value="1">Chó</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <p style="font-weight:bold; margin-bottom:0;color:black">&nbspGiới tính:</p>
                        <select name="genderPet" id="gender-pet" class="custom-select" style="width:250px;">
                            <option value="">Tất cả</option>
                            <option value="0">Cái</option>
                            <option value="1">Đực</option>
                        </select>
                    </div>
                </div>
                <div class="mt-2">
                    <input class="btn btn-primary" type="reset">
                    <button class="btn btn-primary" type="submit " id="submit">Tìm kiếm</button>
                </div>
            </form>
        </div>
        <div class="container-fluid">
            <a class='btn btn-primary mb-3' style='color:white' data-toggle='modal' data-target='#myModal'>Thêm thú cưng</a>
            <div class="alert" role="alert" style="display: none" id="msg-pet"></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-lg-0" scope="col">#</th>
                        <th class="col-lg-1" scope="col">Tên pet</th>
                        <th class="col-lg-1" scope="col">Loại</th>
                        <th class="col-lg-1" scope="col">Giống</th>
                        <th class="col-lg-1" scope="col">Giới tính</th>
                        <th class="col-lg-4" scope="col">Ghi chú</th>
                        <th class="col-lg-3" scope="col">Chủ pet</th>
                        <th class="col-lg-1"></th>
                    </tr>
                </thead>
                <tbody id="data-pet">
                </tbody>
            </table>
        </div>

        <!-- modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-add-pet" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Thêm thú cưng</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-pet"></div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Tên thú</label>
                                <input type="text" class="form-control" id="pet-name-add">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Số điện thoại chủ</label>
                                <input type="text" class="form-control" id="ctm-phone-add">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Giống</label>
                                <input type="text" class="form-control" id="pet-species-add">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Loại</p>
                                <select name="typePetAdd" id="type-pet-add" class="custom-select" style="width:250px;">
                                    <option value="">Tất cả</option>
                                    <option value="0">Mèo</option>
                                    <option value="1">Chó</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Giới tính</p>
                                <select name="genderPetAdd" id="gender-pet-add" class="custom-select" style="width:250px;">
                                    <option value="">Tất cả</option>
                                    <option value="0">Cái</option>
                                    <option value="1">Đực</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Ghi chú</p>
                                <textarea type="text" class="form-control" id="pet-note-add"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="resetAddForm()">Đóng</a>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <!-- modal -->
        <div class="modal fade" id="myModal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-edit-pet" method="post" action="">
                        <div class="modal-header">
                            <h3 class="ml-3 mt-2 mb-0">Sửa thú cưng</h3>
                        </div>
                        <div class="modal-body row">
                            <div class="alert col-12 " role="alert" style="display: none" id="msg-pet-edit"></div>
                            <input type="hidden" id="pet-id-edit">
                            <div class="mb-3 col-5">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Tên thú</label>
                                <input type="text" class="form-control" id="pet-name-edit">
                            </div>
                            <div class="mb-3 col-5">
                                <label for="" class="form-label" style="font-weight:bold; margin-bottom:0;color:black">Giống</label>
                                <input type="text" class="form-control" id="pet-species-edit">
                            </div>
                            <div class="col-lg-4 mb-3">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Loại</p>
                                <select name="typePetEdit" id="type-pet-edit" class="custom-select" style="width:250px;">
                                    <option value="">Tất cả</option>
                                    <option value="0">Mèo</option>
                                    <option value="1">Chó</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Giới tính</p>
                                <select name="genderPetEdit" id="gender-pet-edit" class="custom-select" style="width:250px;">
                                    <option value="">Tất cả</option>
                                    <option value="0">Cái</option>
                                    <option value="1">Đực</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <p style="font-weight:bold; margin-bottom:0;color:black">Ghi chú</p>
                                <textarea type="text" class="form-control" id="pet-note-edit"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-danger" data-dismiss="modal" onclick="reseteditForm()">Đóng</a>
                            <button class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- modal -->

        <div class="row" id="page">
        </div>
    </div>
    <?php include("view/admin/layout/asset-footer.php") ?>
    <script src="asset/admin/js/pet.js?v=<?php echo time() ?>" async></script>

</body>

</html>