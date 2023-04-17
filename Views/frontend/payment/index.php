
<?php 

$this->view('partials.frontend.header',[
    "menus"=>$menus,
    "categories"=>$categories
]) ?>


<div class="container-fluid">
        <!--cartegory--------------------------------------------------------------------------->
        <section class="payment">

            <p class="payment_title">Thông Tin Hóa Đơn Của Bạn</p>
            <div class="payment_app">
                <div class="payment_left">
                    <p class="payment_left-title">Thông tin của bạn</p>
                    <table style="width: 100%;">
                        <tbody>
                            <tr class="line_table">
                                <td>
                                    Ngày đặt:        
                                </td>
                                <td>
                                <?php echo $customer_info['order_date'] ?>
                                </td>    
                            </tr>
                            <tr class="line_table">
                                <td>
                                    Họ và Tên:           
                                </td>
                                <td>
                                    <?php echo $customer_info['name'] ?>
                                </td>  
                            </tr>
                            <tr class="line_table">
                                <td>
                                    Địa chỉ:            
                                </td>
                                <td>
                                <?php echo $customer_info['address']  ?>
                                </td>    
                            </tr>
                            <tr class="line_table">
                                <td>
                                    Số điện thoại:            
                                </td>
                                <td>
                                <?php echo $customer_info['phone'] ?>
                                </td>    
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
               
                <div class="payment_right">
                 <table style="width: 100%;">
                     <tr class="line_table">
                         <th class="payment_right-list">Tên sản phẩm</th>
                         <th class="payment_right-list">Số lượng</th>
                         <th class="payment_right-list">Thành tiền</th>
                     </tr>
                     <?php 
                        foreach($order_info as $key=>$item):
                    ?>
                     <tr>
                         <td><?php  echo $item['name']?></td>
                         <td><?php  echo $item['quantity']?></td>
                         <td><?php  echo $item['quantity']*($item['price']-$item['sale_off'])?></td>
                    </tr>
                <?php
                        endforeach;
                ?>
                 </table>
                 <table style="width: 100%;">
                    <tbody>
                        <tr class="line_table">
                            <td class="payment_right-list-bottom">
                               Tổng tiền hàng:           
                            </td>
                            
                            <td class="paymet_right-item">
                         <b><span style="color: red;"><?php echo $customer_info['total']; ?><sub>đ</sub></span></b>
                            </td>  
                        </tr>
                    </tbody>
                </table>
                </div>
                
            </div>
        </section>
        <section id="Slider"></section>
        <!--footer------------------------------------------------------------------------------>
</div>

<?php $this->view('partials.frontend.footer',[]) ?> 