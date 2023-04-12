<head>
      <link rel="stylesheet" href="./public/css/invoice.css">
      <style>
            .wrapper_invoice {
                  width: 100vw;
                  height: 100vh;
                  display: flex;
                  align-items: center;
                  justify-content: center;
            }

            .container_invoice {
                  width: 90%;
                  height: 90%;
                  background-color: #fff;
                  border-radius: 10px;
                  display: flex;
                  overflow: hidden;
                  border: 1px solid black;
            }

            .side-bar {
                  width: 20%;
                  height: 100%;
                  border-right: 1px solid black;
                  padding: 20px 10px;
                  background: var(--main_bgc);
            }

            .side-bar h1 {
                  text-transform: uppercase;
                  font-weight: bold;
                  margin-bottom: 20px;
                  color: white
            }

            .side-bar ul li {
                  width: 100%;
                  padding: 5px;
                  color: white;
                  cursor: pointer;
            }

            .side-bar ul li:hover {
                  color: red
            }

            .side-bar ul li:hover>i {
                  transition: all 0.5s ease;
                  transform: rotate(90deg);
                  margin-right: 60px;
            }

            .box_detail {
                  left: 0;
                  width: 100%;
                  background-color: white;
                  height: 0px;
                  margin-top: 5px;
                  overflow: hidden;
            }

            .side-bar ul li:hover>.box_detail {
                  height: auto;
            }

            .box_invoice {
                  border: 1px solid white;
            }

            .title_invoice {
                  width: 100%;
                  display: inline-block;
                  padding: 5px 20px;
                  background: var(--main_bgc);
                  color: white
            }

            .box_invoice p {
                  color: black;
                  display: block;
                  padding: 2px 10px;
            }

            .box_invoice p:hover {
                  color: red;
            }

            .aside_content {
                  width: 80%;
                  padding: 30px;
            }
      </style>
</head>

<body>
      <div id="invoice_total" class="hidden content-pos-view">
            <div class="wrapper_invoice">
                  <div class="container_invoice">
                        <nav class="side-bar">
                              <h1>HÓA ĐƠN</h1>
                              <ul>
                                    <?php
                                    require_once PATH_APPLICATION . '/core/Base_Model.php';
                                    $db = new Base_Model();
                                    $Store = $db->conn->query("SELECT * FROM kho");
                                    foreach ($Store as $item) {
                                          $id_kho = $item['id_kho'];
                                          $invoice_import = $db->conn->query("SELECT * FROM hoadonnhapkho WHERE kho = '$id_kho'");
                                          $invoice_export = $db->conn->query("SELECT * FROM hoadonxuatkho WHERE kho = '$id_kho'");
                                    ?>
                                          <li><i class="fa-solid fa-chevron-right"></i> <?= $item['tenkho'] ?>
                                                <div class="box_detail">
                                                      <div class="box_invoice">
                                                            <span class="title_invoice"> + Hóa đơn nhập kho</span>
                                                            <?php
                                                            foreach ($invoice_import as $import) {
                                                            ?>
                                                                  <p class="invoice_import" id="aside<?= $import['id_hoadonnhapkho'] ?>"> - <?= $import['thoigiannhap'] ?></p>
                                                            <?php
                                                            }
                                                            ?>
                                                      </div>
                                                      <div class="box_invoice">
                                                            <span class="title_invoice"> + Hóa đơn xuất kho</span>
                                                            <?php
                                                            foreach ($invoice_export as $export) {
                                                            ?>
                                                                  <p class="invoice_export" id="aside<?= $export['id_hoadonxuatkho'] ?>"> - <?= $export['thoigianxuat'] ?></p>
                                                            <?php
                                                            }
                                                            ?>
                                                      </div>
                                                </div>
                                          </li>
                                    <?php
                                    }
                                    ?>
                              </ul>
                        </nav>
                        <?php
                        $invoices = $db->conn->query("SELECT * FROM hoadonnhapkho");
                        foreach ($invoices as $invoice) {
                              $id_kho = $invoice['id_hoadonnhapkho'];
                              $info_invoice = $db->conn->query("SELECT *, CONCAT(b.tenlot, ' ', b.tennhanvien) as hovatennhanvien FROM hoadonnhapkho a, nhanvien b, nhaphanphoi c, kho d
                                                                       WHERE a.nhanvien = b.id_nhanvien AND a.nhaphanphoi = c.id_nhaphanphoi
                                                                       AND a.kho = d.id_kho AND a.id_hoadonnhapkho = '$id_kho'");
                              $row_info = $info_invoice->fetch_assoc();
                        ?>
                              <aside class="aside_content import_content hidden" id="aside<?= $invoice['id_hoadonnhapkho'] ?>">
                                    <table class="invoice-info-container">
                                          <tr>
                                                <td><span class="title_desc">Kho nhập hàng: </span> - <?= $row_info['tenkho'] ?></td>
                                                <td style="text-align: right"><span class="title_desc">Nhà phân phối: </span> - <?= $row_info['tennhaphanphoi'] ?></td>
                                          </tr>
                                          <tr>
                                                <td><span class="title_desc">Quản lý kho: </span> - <?= $row_info['hovatennhanvien'] ?></td>
                                                <td style="text-align: right"><span class="title_desc">Mã số thuế: </span> - <?= $row_info['masothue'] ?></td>
                                          </tr>
                                          <td><span class="title_desc">Mã hóa đơn: </span> - HD00<?= $row_info['id_hoadonnhapkho'] ?></td>
                                          <td style="text-align: right"><span class="title_desc">Địa chỉ: </span> - <?= $row_info['diachi'] ?></td>
                                          <tr>
                                    </table>

                                    <div class="name_invoice">
                                          <h1 style="text-transform: uppercase;">HÓA ĐƠN NHẬP KHO <?= $row_info['tenkho'] ?></h1>
                                          <?php
                                          $date = getdate();
                                          ?><span class="curent_time">Ngày <?= $date['mday'] ?> Tháng <?= $date['mon'] ?> năm <?= $date['year'] ?></span> <?php
                                                                                                                                                            ?>
                                    </div>

                                    <table border="1">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>Tên sản phẩm</th>
                                                      <th>Số lượng</th>
                                                      <th>Đơn vị tính</th>
                                                      <th>Đơn giá</th>
                                                      <th>Xuất xứ</th>
                                                      <th>ngày hết hạn</th>
                                                      <th>Thành tiền</th>
                                                      <th>Ghi chú</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                if (!function_exists('currency_format')) {
                                                      function currency_format($number, $suffix = ' vnđ')
                                                      {
                                                            if (!empty($number)) {
                                                                  return number_format($number, 0, ',', '.') . "{$suffix}";
                                                            }
                                                      }
                                                }


                                                $invoice_total = $db->conn->query("SELECT *, a.soluong as soluongnhap, a.ghichu as ghichunhap FROM chitietnhapkho a, donvitinh e, hanghoa f
                                                                                   WHERE a.sanpham = f.id_hanghoa AND a.hoadon = $id_kho AND f.donvitinh = e.id_donvitinh");
                                                $i = 1;
                                                $total_price = 0;
                                                if (!empty($invoice_total)) {
                                                      foreach ($invoice_total as $product) {
                                                            $total_price += $product['gianhap'] * $product['soluongnhap'];
                                                ?>
                                                            <tr style="text-align: center;">
                                                                  <td><?= $i++ ?></td>
                                                                  <td><?= $product['tenhanghoa'] ?></td>
                                                                  <td><?= $product['soluongnhap'] ?></td>
                                                                  <td><?= $product['tendonvitinh'] ?></td>
                                                                  <td><?= currency_format($product['gianhap']) ?></td>
                                                                  <td><?= $product['xuatxu'] ?></td>
                                                                  <td><?= $product['hansudung'] ?> ngày</td>
                                                                  <td><?= currency_format($product['gianhap'] * $product['soluongnhap']) ?></td>
                                                                  <td><?= $product['ghichunhap'] ?></td>
                                                            </tr>
                                                <?php
                                                      }
                                                }
                                                ?>
                                                <tr class="complete_invoice">
                                                      <td colspan="7" style="color: red">Tổng cộng:</td>
                                                      <td style="color: red"><?= currency_format($total_price) ?></td>
                                                      <td></td>
                                                </tr>
                                                <?php
                                                ?>

                                          </tbody>
                                    </table>

                                    <div class="box-end d-flex" style="justify-content: space-between; margin: 10px 120px; text-align: center;">
                                          <div class="name">
                                                <h4 style="font-weight: bold;">Nhân viên nhập kho</h4>
                                                <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
                                          </div>
                                          <div class="name">
                                                <h4 style="font-weight: bold;">Nhà phân phối</h4>
                                                <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
                                          </div>
                                    </div>


                                    <div class="footer">
                                          <form action="?c=import&a=complete_import" method="POST" class="footer-info">
                                                <span><button type="submit" class="btn save-btn">In hóa đơn</button></span> |
                                          </form>
                                    </div>
                              </aside>
                        <?php
                        }
                        ?>

                        <?php
                        $invoices_export = $db->conn->query("SELECT * FROM hoadonxuatkho");
                        foreach ($invoices_export as $invoice_export) {
                              $id_kho = $invoice_export['id_hoadonxuatkho'];
                              $info_invoice = $db->conn->query("SELECT *, CONCAT(b.tenlot, ' ', b.tennhanvien) as hovatennhanvien, CONCAT(c.tenlot, ' ', c.tenkhachhang) as hovatenkhachhang, c.diachi as diachikhachhang 
                                                                       FROM hoadonxuatkho a, nhanvien b, khachhang c, kho d
                                                                       WHERE a.nhanvien = b.id_nhanvien AND a.khachhang = c.id_khachhang
                                                                       AND a.kho = d.id_kho AND a.id_hoadonxuatkho = '$id_kho'");
                              $row_info = $info_invoice->fetch_assoc();
                        ?>
                              <aside class="aside_content export_content hidden" id="aside<?= $row_info['id_hoadonxuatkho'] ?>">
                                    <table class="invoice-info-container">
                                          <tr>
                                                <td><span class="title_desc">Kho xuất hàng: </span> - <?= $row_info['tenkho'] ?></td>
                                                <td style="text-align: right"><span class="title_desc">Khách hàng: </span> - <?= $row_info['hovatenkhachhang'] ?></td>
                                          </tr>
                                          <td><span class="title_desc">Mã hóa đơn: </span> - HD00<?=$row_info['id_hoadonxuatkho'] ?></td>
                                          <td style="text-align: right"><span class="title_desc">Địa chỉ: </span> - <?= $row_info['diachikhachhang'] ?></td>
                                          <tr>
                                    </table>

                                    <div class="name_invoice">
                                          <h1 style="text-transform: uppercase;">HÓA ĐƠN XUẤT KHO <?=$row_info['tenkho'] ?></h1>
                                          <?php
                                          $date = getdate();
                                          ?><span class="curent_time">Ngày <?= $date['mday'] ?> Tháng <?= $date['mon'] ?> năm <?= $date['year'] ?></span> <?php
                                                                                                                  ?>
                                    </div>

                                    <table border="1">
                                          <thead>
                                                <tr>
                                                      <th>STT</th>
                                                      <th>Tên sản phẩm</th>
                                                      <th>Đơn vị tính</th>
                                                      <th>Số lượng</th>
                                                      <th>Đơn giá</th>
                                                      <th>Thành tiền</th>
                                                      <th>Ghi chú</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                if (!function_exists('currency_format')) {
                                                      function currency_format($number, $suffix = ' vnđ')
                                                      {
                                                            if (!empty($number)) {
                                                                  return number_format($number, 0, ',', '.') . "{$suffix}";
                                                            }
                                                      }
                                                }
                                                
                                                $export_total = $db->conn->query("SELECT *, a.soluong as soluongxuat, a.ghichu as ghichuxuat FROM chitietxuatkho a, donvitinh e, hanghoa f
                                                                                   WHERE a.sanpham = f.id_hanghoa AND a.hoadon = $id_kho AND f.donvitinh = e.id_donvitinh");
                                                $i = 1;
                                                $total_price = 0;
                                                if (!empty($export_total)) {
                                                      foreach ($export_total as $product) {
                                                            $total_price += $product['giabansi'] * $product['soluongxuat'];
                                                ?>
                                                            <tr style="text-align: center;">
                                                                  <td><?= $i++ ?></td>
                                                                  <td><?= $product['tenhanghoa'] ?></td>
                                                                  <td><?= $product['tendonvitinh'] ?></td>
                                                                  <td><?= $product['soluongxuat'] ?></td>
                                                                  <td><?= currency_format($product['giabansi']) ?></td>
                                                                  <td><?= currency_format($product['giabansi'] * $product['soluongxuat']) ?></td>
                                                                  <td><?= $product['ghichuxuat'] ?></td>
                                                            </tr>
                                                <?php
                                                      }
                                                }
                                                ?>
                                                <tr class="complete_invoice" style="color: red">
                                                      <td colspan="5">Tổng cộng:</td>
                                                      <td ><?= currency_format($total_price) ?></td>
                                                      <td></td>
                                                </tr>
                                                <?php
                                                ?>

                                          </tbody>
                                    </table>

                                    <div class="box-end d-flex" style="justify-content: space-between; margin: 10px 120px; text-align: center;">
                                          <div class="name">
                                                <h4 style="font-weight: bold;">Nhân viên xuất kho</h4>
                                                <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
                                          </div>
                                          <div class="name">
                                                <h4 style="font-weight: bold;">Khách hàng</h4>
                                                <span><i style="font-size: 12px">(Ký và ghi rõ họ tên)</i></span>
                                          </div>
                                    </div>


                                    <div class="footer">
                                          <form action="?c=export&a=complete_export" method="POST" class="footer-info">
                                                <span><button type="submit" class="btn save-btn">In hóa đơn</button></span> |
                                          </form>
                                    </div>
                              </aside>
                        <?php
                        }
                        ?>


                  </div>
            </div>
      </div>
</body>

<script type="text/javascript">
      var invoice_imports = document.querySelectorAll('.invoice_import')
      var invoice_exports = document.querySelectorAll('.invoice_export')
      var import_contents = document.querySelectorAll('.import_content')
      var export_contents = document.querySelectorAll('.export_content')

      invoice_imports.forEach(item => {
            item.addEventListener('click', function(e) {
                  export_contents.forEach(itemm => {
                        itemm.classList.add('hidden')
                  })
                  import_contents.forEach(aside => {
                        aside.classList.add('hidden')
                        if (item.id == aside.id) {
                              aside.classList.remove('hidden')
                        }
                  })
            })
      })

      invoice_exports.forEach(item => {
            item.addEventListener('click', function(e) {
                  import_contents.forEach(itemm => {
                        itemm.classList.add('hidden')
                  })
                  export_contents.forEach(aside => {
                        aside.classList.add('hidden')
                        if (item.id == aside.id) {
                              aside.classList.remove('hidden')
                        }
                  })
            })
      })
</script>