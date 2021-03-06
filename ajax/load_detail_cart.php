<?php
    require_once('../connector/connection.php');
    $stmt = $conn -> prepare("SELECT p.*, c.quantity, c.id_cart FROM cart c, product p WHERE id_user = ? AND p.id = c.id_product");
    $stmt -> bind_param("i", $_SESSION['user-login']['id']);
    $stmt -> execute();
    $carts = $stmt -> get_result() -> fetch_all(MYSQLI_ASSOC);
?>
<?php if ($carts == null || $carts == "") { ?> 
    <h2>Kosong...</h2>
<?php } else { ?>
    <?php $total = 0; ?>
    <?php foreach ($carts as $key => $cart_item) { ?>
        <?php 
            $subtotal = $cart_item['quantity'] * $cart_item['price'];
            $total += $subtotal;
        ?>
        <tr class="align-middle">
            <th scope="row"><?=$key + 1?></th>
            <td class="text-center imgCart">
                <a href="detailProduk.php?product=<?= $cart_item['id']?>">
                    <img class="hover-expand" style="width: 100px;" src="<?= $cart_item['image_source'] ?>" alt="">
                </a>
            </td>
            <td>
                <a class="text-decoration-none color-inherit" href="detailProduk.php?product=<?= $cart_item['id']?>">
                    <?=$cart_item['name']?>
                </a>
            </td>
            <td class="tipeCart" ><?=$cart_item['type']?></td>
            <td><?="Rp. " . getFormatHarga($cart_item['price'])?></td>
            <td class="qtyCartLengkap" >
                <button class="btn btn-outline-secondary " id="btnDownQty" type="button" onclick="editQuantity(-1, <?=$cart_item['id_cart']?>)">-</button>
                <button class="btn btn-outline-secondary " disabled><?=$cart_item['quantity']?></button>
                <button class="btn btn-outline-secondary " id="btnUpQty"  type="button" onclick="editQuantity(1, <?=$cart_item['id_cart']?>)">+</button>
            </td>
            <td class="qtyCartSingle "  >
                <button class="btn btn-outline-secondary w-100 " onclick="qtyCartManual(<?=$cart_item['quantity']?>,<?=$cart_item['id_cart']?>)"><?=$cart_item['quantity']?></button>
            </td>
            <td><?="Rp. " . getFormatHarga($cart_item['price'] * $cart_item['quantity'])?></td>
            <td>
                <i class="hover fa fa-trash fa-2x" aria-hidden="true" onclick="deleteCart(<?=$cart_item['id_cart']?>)"></i>
            </td>
        </tr>
    <?php } ?>
<?php } ?>