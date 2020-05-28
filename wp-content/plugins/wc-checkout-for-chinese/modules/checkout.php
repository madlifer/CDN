<?php

/**
 * @Author: suifengtec
 * @Date:   2018-01-21 18:44:12
 * @Last Modified by:   suifengtec
 * @Last Modified time: 2018-01-22 08:34:29
 **/


if ( ! defined( 'ABSPATH' ) ){
    exit;
}

/*


*/
class WC_C4C_Module_Checkout{

    public function __construct(){
         add_action('woocommerce_loaded',array($this,'woocommerce_loaded'),11);
    }

    public function woocommerce_loaded(){

        if(!function_exists('wc')){
            return;
        }

        add_filter('woocommerce_default_address_fields',array($this,'woocommerce_default_address_fields'),11,1);

        /*
        自定义栏目

                //suifengtec
                //woocommerce/includes/class-wc-contries.php
                else{
                    return  apply_filters('woocommerce_countries_get_attribute',null,$key);
                }
         */
        add_filter('woocommerce_form_field_city', array($this,'woocommerce_form_field_city'), 12, 4);
        add_filter('woocommerce_countries_get_attribute' , array($this,'woocommerce_countries_get_attribute'),10,2);


        add_action('wp_ajax_wc_province_changed',array($this,'wc_province_changed'));
        add_action('wp_ajax_nopriv_wc_province_changed',array($this,'wc_province_changed'));


        add_filter( 'woocommerce_states', array($this,'woocommerce_states') );


        /*收货地址,必须有手机号*/
        /*

        $fields = $checkout->get_checkout_fields( 'shipping' );
'shipping' => WC()->countries->get_address_fields( $this->get_value( 'shipping_country' ), 'shipping_' )


apply_filters( 'woocommerce_' . $type . 'fields', $address_fields, $country );

         */

        add_filter('woocommerce_shipping_fields',array($this,'woocommerce_shipping_fields'),11,2);

        /*
        结算时,收到的数据
        apply_filters( 'woocommerce_checkout_posted_data', $data );

         */
/*        add_filter('woocommerce_checkout_posted_data',array($this,'woocommerce_checkout_posted_data'),10,1);*/

        /*
        收货地址:结算时,保存手机号码
        do_action( 'woocommerce_checkout_update_order_meta', $order_id, $data );
         */
/*        add_action('woocommerce_checkout_update_order_meta',array($this,'woocommerce_checkout_update_order_meta'),10,2);
*/

        /*
        订单的地址数组
ORDER

    public function get_address( $type = 'billing' ) {
        return apply_filters( 'woocommerce_get_order_address', array_merge( $this->data[ $type ], $this->get_prop( $type, 'view' ) ), $type, $this );
    }

         */

            add_filter('woocommerce_get_order_address',array($this,'woocommerce_get_order_address'),11,3);

            /*
            订单地址的格式化
        $order->get_formatted_billing_address()
        $order->get_formatted_shipping_address()



             WC()->countries->get_formatted_address( apply_filters( 'woocommerce_order_formatted_billing_address', $this->get_address( 'billing' ), $this ) );

                woocommerce_localisation_address_formats
             */
                add_filter('woocommerce_localisation_address_formats',array($this,'woocommerce_localisation_address_formats'),10,1);
            /*
            为了更快加载后台订单列表页面
            后台->订单列表页面->订单项目的地图链接

            $address = apply_filters( 'woocommerce_shipping_address_map_url_parts', $address, $this );


           apply_filters( 'woocommerce_shipping_address_map_url', 'https://maps.google.com/maps?&q=' . urlencode( implode( ', ', $address ) ) . '&z=16', $this );

             */

            add_filter('woocommerce_shipping_address_map_url',array($this,'woocommerce_shipping_address_map_url'),10,2);

            /*

            顾客

            get_address_prop

            woocommerce_customer_get_shipping_phone

            $value = apply_filters( $this->get_hook_prefix() . $address . '_' . $prop, $value, $this );
             */

            /*

            后台->个人资料
                woocommerce/includes/admin/class-wc-admin-profile.php
             */

        add_filter('woocommerce_customer_meta_fields', array($this,'woocommerce_customer_meta_fields'),10,1);

        /*
        前台->订单查看页面
        do_action('woocommerce_after_formatted_shipping_address',$order);


/woocommerce/templates/order/order-details-customer.php

中的
echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' );

下添加

//suifengtec
do_action('woocommerce_after_formatted_shipping_address',$order);

         */
        add_action('woocommerce_after_formatted_shipping_address',array($this,'woocommerce_after_formatted_shipping_address'),10,1);

/*

手机号

$data[ $key ] = wc_format_phone_number( $data[ $key ] );

WC_Validation::is_phone( $data[ $key ] )

 */



/*
我的账户->地址

apply_filters( 'woocommerce_my_account_my_address_formatted_address', $address, $customer->get_id(), $address_type )


 */
        add_filter('woocommerce_my_account_my_address_formatted_address',array($this,'woocommerce_my_account_my_address_formatted_address'),10,3);


        /*格式化地址前的占位符数组*/
        add_filter('woocommerce_formatted_address_replacements',array($this,'woocommerce_formatted_address_replacements'),10,2);

    }


    public function woocommerce_formatted_address_replacements($arr,$args){


            $arr['{phone}'] = !empty($args['phone'])?$args['phone']:'';

            return $arr;
    }

    public function woocommerce_my_account_my_address_formatted_address($addressArr, $user_id, $address_type){

            if('shipping'==$address_type){
                 $addressArr['phone'] = get_user_meta($user_id,'shipping_phone',true);


/*   var_dump($addressArr);
*/
            }



        return $addressArr;
    }

    public function woocommerce_after_formatted_shipping_address($order){

            $orderData = $order->get_data();
            $shippingAddressData = $orderData['meta_data'];
            if(empty($shippingAddressData)){
                return ;
            }
            $shippingAddressArr = json_decode(json_encode($shippingAddressData),true);
            if(empty( $shippingAddressArr)){
                return ;
            }
             $shipping_phone = false;
            foreach($shippingAddressArr as $k=>$v){
               if(isset($v['key'])&&$v['key']=='_shipping_phone'){
                         $shipping_phone = $v['value'];
                         continue;
               }

            }
            if(!$shipping_phone){
                return ;
            }
/*

  <p class="woocommerce-customer-details--phone"><?php echo esc_html( $shipping_phone); ?></p>
 */
            echo esc_html( '   '.$shipping_phone);
        ?>

        <?php

    }



    public function woocommerce_localisation_address_formats($formatArr){
        /*

        'CN' => "{country} {postcode}\n{state}, {city}, {address_2}, {address_1}\n{company}\n{name}",
         */
        $formatArr['CN'] = "{state}{city}{address_1}{address_2}\n{name} {phone}";
        return $formatArr;
    }




        /**
         * 为了更快加载后台订单列表页面
         * @param  [type] $mapUrl [description]
         * @param  [type] $order  [description]
         * @return [type]         [description]
         */
        public function woocommerce_shipping_address_map_url($mapUrl,$order){
            $mapUrl = '';
            return $mapUrl;
        }


        /*DEV*/
        public function woocommerce_get_order_address($addressArr,$type,$order){

/*
'billing'================
array (size=11)
  'first_name' => string '王二狗' (length=9)
  'last_name' => string '' (length=0)
  'company' => string '' (length=0)
  'address_1' => string '假装这里是详细地址' (length=27)
  'address_2' => string '' (length=0)
  'city' => string '杭州市' (length=9)
  'state' => string 'CN12' (length=4)
  'postcode' => string '' (length=0)
  'country' => string 'CN' (length=2)
  'email' => string 'suifengtec@qq.com' (length=17)
  'phone' => string '13800138001' (length=11)


'shipping'================

array (size=9)
  'first_name' => string '王二狗' (length=9)
  'last_name' => string '' (length=0)
  'company' => string '' (length=0)
  'address_1' => string '假装这里是详细地址' (length=27)
  'address_2' => string '' (length=0)
  'city' => string '黄浦区' (length=9)
  'state' => string 'CN10' (length=4)
  'postcode' => string '' (length=0)
  'country' => string 'CN' (length=2)


$c = new WC_Customer;


 */
                /*var_dump($order);*/

                switch ($type) {
                    case 'billing':
                        # code...
                        break;

                    case 'shipping':
                        # code...
                        break;
                }

                if(isset($addressArr['postcode'])){
                    unset($addressArr['postcode']);
                }

                return $addressArr;
        }

    public function woocommerce_shipping_fields($fields, $country){


            if('CN'==strtoupper($country)){


            $fields['shipping_phone'] = array(
                'label'        => __( 'Phone', 'woocommerce' ),
                'required'     => true,
                'type'         => 'tel',
                'class'        => array( 'form-row-wide' ),
                'validate'     => array( 'phone' ),
                'autocomplete' => 'tel',
                'priority'     => 100,
            );


            }
            return $fields;
    }

    public function wc_province_changed(){


        if(empty($_POST['pid'])){
            wp_send_json_error( false );
        }

              $for_province = $_POST['pid'].'_getCities';


                $cities = $this->woocommerce_countries_get_attribute([], $for_province);

                $r = [
                    'cs'=>$cities,
                /*    'for_province'=>$for_province,*/

                ];

        wp_send_json_success($r);

    }

    public function woocommerce_form_field_city($field, $key, $args, $value){
        /*

        $key: billing_city, shipping_city
        $key: billing_city, shipping_city
         */

   /*     var_dump($args);*/

        $custom_attributes         = array();
        if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
            foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
                $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
            }
        }
        if ( $args['required'] ) {
            $args['class'][] = 'validate-required';
            $required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
        } else {
            $required = '';
        }
        $sort            = $args['priority'] ? $args['priority'] : '';

        $label_id        = $args['id'];
        $field_container = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</p>';



        switch ($args['type']) {
            case 'city':




/*                $field = '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';*/

/*============================*/
            /*
            $for_province: 'CN17'

             */

           $for_province = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );

                $for_province = isset( $args['state'] ) ? $args['state'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_state' : 'shipping_state' );

                /*
                .'C'
                 */
/*
*/


        $for_province = $for_province ?$for_province.'_getCities' :'';




                global $woocommerce;
                $states      = WC()->countries->$for_province;
                /*$states      = $coutries->get( $for_province );*/



                if ( is_array( $states ) && empty( $states ) ) {

                    $field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

                    $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" />';

                } elseif ( ! is_null($for_province ) && is_array( $states ) ) {

                    $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                        <option value="">请选择城市...</option>';

                    foreach ( $states as $ckey => $cvalue ) {
                        $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                    }

                    $field .= '</select>';

                } else {

                    $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

                }


/*============================*/



                break;

        }


        if ( ! empty( $field ) ) {
            $field_html = '';

            if ( $args['label'] && 'checkbox' != $args['type'] ) {
                $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
            }

            $field_html .= $field;

            if ( $args['description'] ) {
                $field_html .= '<span class="description">' . esc_html( $args['description'] ) . '</span>';
            }

            $container_class = esc_attr( implode( ' ', $args['class'] ) );
            $container_id    = esc_attr( $args['id'] ) . '_field';
            $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
        }


            return $field;
    }



    public function woocommerce_default_address_fields($fields){

        $fields = array(

/*            'last_name' => array(
                'label'        => __( 'Last name', 'woocommerce' ),
                'required'     => true,
                'class'        => array( 'form-row-last' ),
                'autocomplete' => 'family-name',
                'priority'     => 20,
            ),*/
/*            'company' => array(
                'label'        => __( 'Company name', 'woocommerce' ),
                'class'        => array( 'form-row-wide' ),
                'autocomplete' => 'organization',
                'priority'     => 30,
            ),*/
            'country' => array(
                'type'         => 'country',
                'label'        => '国家/地区',
                'required'     => true,
                'class'        => array( 'form-row-first', 'address-field', 'update_totals_on_change' ),
                'autocomplete' => 'country',
                'priority'     => 40,
            ),
            'state' => array(
                'type'         => 'state',
                'label'        => '省级区域',
                'required'     => true,
                'class'        => array( 'form-row-last', 'address-field' ),
                'validate'     => array( 'state' ),
                'autocomplete' => 'address-level1',
                'priority'     => 50,
            ),
            'city' => array(
                'type'         => 'city',
                'label'        => '市级区域',
                'required'     => true,
                'class'        => array( 'form-row-wide', 'address-field' ),
                'autocomplete' => 'address-level2',
                'priority'     => 60,
            ),
            'address_1' => array(
                'label'        => '详细地址',
                'placeholder'  => '县级区域,街道/镇,小区/村,楼号,房屋编号',
                'required'     => true,
                'class'        => array( 'form-row-wide', 'address-field' ),
                'autocomplete' => 'address-line1',
                'priority'     => 70,
            ),
            'first_name' => array(
                'label'        => '收货人姓名',
                'required'     => true,
                'class'        => array( 'form-row-wide'),
                'autocomplete' => 'given-name',
                'autofocus'    => true,
                'priority'     => 80,
            ),
        );
        /*
        unset($fields['last_name']);
        unset($fields['company']);
        unset($fields['address_2']);
        unset($fields['postcode']);
        */
        return $fields;
    }

    public function woocommerce_countries_get_attribute($return,$key){



        if(false===strpos($key, '_getCities')){
            return $return ;
        }else{

            $key = str_replace('_getCities', '', $key);
        }

        $cities =[
        'CN2'/*北京*/=>  ['东城区','西城区','崇文区','宣武区','朝阳区','丰台区','石景山区','海淀区','门头沟区','房山区','通州区','顺义区','昌平区','大兴区','怀柔区','平谷区','密云县','延庆县','延庆镇'],
        'CN10'/*上海*/=> ['黄浦区','卢湾区','徐汇区','长宁区','静安区','普陀区','闸北区','虹口区','杨浦区','闵行区','宝山区','嘉定区','浦东新区','金山区','松江区','青浦区','南汇区','奉贤区','崇明县','城桥镇'],

        'CN20' /*广东*/=> ['广州市','深圳市','清远市','韶关市','河源市','梅州市','潮州市','汕头市','揭阳市','汕尾市','惠州市','东莞市','珠海市','中山市','江门市','佛山市','肇庆市','云浮市','阳江市','茂名市','湛江市'],

        'CN3'/*天津*/=> ['和平区','河东区','河西区','南开区','河北区','红桥区','塘沽区','汉沽区','大港区','东丽区','西青区','津南区','北辰区','武清区','宝坻区','蓟县','宁河县','芦台镇','静海县','静海镇'],

        'CN23'/*重庆*/=> ['渝中区','大渡口区','江北区','沙坪坝区','九龙坡区','南岸区','北碚区','万盛区','双桥区','渝北区','巴南区','万州区','涪陵区','黔江区','长寿区','合川市','永川区市','江津市','南川市','綦江县','潼南县','铜梁县','大足县','荣昌县','璧山县','垫江县','武隆县','丰都县','城口县','梁平县','开县','巫溪县','巫山县','奉节县','云阳县','忠县','石柱土家族自治县','彭水苗族土家族自治县','酉阳土家族苗族自治县','秀山土家族苗族自治县'],


        'CN17'/*河南*/=> ['郑州市','开封市','三门峡市','洛阳市','焦作市','新乡市','鹤壁市','安阳市','濮阳市','商丘市','许昌市','漯河市','平顶山市','南阳市','信阳市','周口市','驻马店市','济源市'],
        'CN4'/*河北*/=>['石家庄市','张家口市','承德市','秦皇岛市','唐山市','廊坊市','保定市','衡水市','沧州市','邢台市','邯郸市'],
        'CN1'/*云南*/=>['昆明市','曲靖市','玉溪市','保山市','昭通市','丽江市','思茅市','临沧市','德宏州','怒江州','迪庆州','大理州','楚雄州','红河州','文山州','西双版纳州'],

        'CN5'/*陕西*/=> ['西安市','延安市','铜川市','渭南市','咸阳市','宝鸡市','汉中市','榆林市','安康市','商洛市'],
        'CN6'/*内蒙*/=> ['呼和浩特市','包头市','乌海市','赤峰市','通辽市','呼伦贝尔市','鄂尔多斯市','乌兰察布市','巴彦淖尔市','兴安盟','锡林郭勒盟','阿拉善盟'],
        'CN7'/*辽宁*/=> ['沈阳市','朝阳市','阜新市','铁岭市','抚顺市','本溪市','辽阳市','鞍山市','丹东市','大连市','营口市','盘锦市','锦州市','葫芦岛市'],
        'CN8'/*吉林*/=>['长春市','白城市','松原市','吉林市','四平市','辽源市','通化市','白山市','延边州'],
        'CN9'/*黑龙江*/=> ['哈尔滨市','齐齐哈尔市','七台河市','黑河市','大庆市','鹤岗市','伊春市','佳木斯市','双鸭山市','鸡西市','牡丹江市','绥化市','大兴安岭地区'],
        'CN11'/*江苏*/=> ['南京市','徐州市','连云港市','宿迁市','淮安市','盐城市','扬州市','泰州市','南通市','镇江市','常州市','无锡市','苏州市'],
        'CN12'/*浙江*/=> ['杭州市','湖州市','嘉兴市','舟山市','宁波市','绍兴市','衢州市','金华市','台州市','温州市','丽水市'],
        'CN13'/*安徽*/=> ['合肥市','宿州市','淮北市','亳州市','阜阳市','蚌埠市','淮南市','滁州市','马鞍山市','芜湖市','铜陵市','安庆市','黄山市','六安市','巢湖市','池州市','宣城市'],

        'CN14'/*福建*/=> ['福州市','南平市','莆田市','三明市','泉州市','厦门市','漳州市','龙岩市','宁德市'],

        'CN15'/*江西*/=> ['南昌市','九江市','景德镇市','鹰潭市','新余市','萍乡市','赣州市','上饶市','抚州市','宜春市','吉安市'],
        'CN16'/*山东*/=> ['济南市','青岛市','聊城市','德州市','东营市','淄博市','潍坊市','烟台市','威海市','日照市','临沂市','枣庄市','济宁市','泰安市','莱芜市','滨州市','菏泽市'],
        'CN18'/*湖北*/=> ['武汉市','十堰市','襄樊市','荆门市','孝感市','黄冈市','鄂州市','黄石市','咸宁市','荆州市','宜昌市','随州市','省直辖县级行政单位','恩施州'],

        'CN19' /*湖南*/=> ['长沙市','张家界市','常德市','益阳市','岳阳市','株洲市','湘潭市','衡阳市','郴州市','永州市','邵阳市','怀化市','娄底市','湘西州'],
        'CN21' /*广西*/=> ['南宁市','桂林市','柳州市','梧州市','贵港市','玉林市','钦州市','北海市','防城港市','崇左市','百色市','河池市','来宾市','贺州市'],
        'CN22'/*海南*/=> ['海口市','三亚市','三沙市','省直辖行政单位'],
        'CN24' /*四川*/=>  ['成都市','广元市','绵阳市','德阳市','南充市','广安市','遂宁市','内江市','乐山市','自贡市','泸州市','宜宾市','攀枝花市','巴中市','达州市','资阳市','眉山市','雅安市','阿坝州','甘孜州','凉山州'],
        'CN25' /*贵州*/=> ['贵阳市','六盘水市','遵义市','安顺市','毕节地区','铜仁地区','黔东南州','黔南州','黔西南州'],
        'CN26' /*山西*/=> ['太原市','朔州市','大同市','阳泉市','长治市','晋城市','忻州市','晋中市','临汾市','吕梁市','运城市'],
        'CN27' /*甘肃*/=> ['兰州市','嘉峪关市','白银市','天水市','武威市','酒泉市','张掖市','庆阳市','平凉市','定西市','陇南市','临夏州','甘南州'],
        'CN28'/*青海*/ => ['西宁市','海东地区','海北州','海南州','黄南州','果洛州','玉树州','海西州'],
        'CN29'/*宁夏*/ => ['银川市','石嘴山市','吴忠市','固原市','中卫市'],
        'CN32' /*新疆*/=> ['乌鲁木齐市','克拉玛依市','自治区直辖县级行政单位','喀什地区','阿克苏地区','和田地区','吐鲁番地区','哈密地区','克孜勒苏柯州','博尔塔拉州','昌吉州','巴音郭楞州','伊犁州','塔城地区','阿勒泰地区'],
        'CN31' /*西藏*/ => ['拉萨市','那曲地区','昌都地区','林芝地区','山南地区','日喀则地区','阿里地区'],
        'CN30'  /*澳门*/=> ['澳门'],
        'CN33'  /*香港*/=> ['香港'],
/*        'CN34'  => ['台北市','新北市','桃园市','台中市','台南市','高雄市','基隆市','新竹市','嘉义市','宜兰县(宜兰市)','新竹县(竹北市)','苗栗县(苗栗市)','彰化县(彰化市)','南投县(南投市)','嘉义县(太保市)','云林县(斗六市)','屏东县(屏东市)','台东县(台东市)','花莲县(花莲市)','澎湖县(马公市)' ],*/
        ];
        $cs = [];
        if(!empty($cities[$key])){
                    foreach($cities[$key] as $k=>$v){
                        $cs[$v] = $v;
                    }
        }
        return $cs;

    }


    public function woocommerce_states($states){

        global $states;
        $states['CN'] = [
            'CN2'  => '北京',
            'CN10' => '上海',
            'CN20' => '广东',
            'CN12' => '浙江',
            'CN17' =>'河南',
            'CN23' => '重庆',
            'CN3'  => '天津',
            'CN11' => '江苏',
            'CN1'  => '云南',
            'CN4'  => '河北',
            'CN5'  => '陕西',
            'CN6'  => '内蒙古',
            'CN7'  => '辽宁',
            'CN8'  => '吉林',
            'CN9'  => '黑龙江',
            'CN13' => '安徽',
            'CN14' => '福建',
            'CN15' => '江西',
            'CN16' => '山东',
            'CN18' => '湖北',
            'CN19' => '湖南',
            'CN21' => '广西',
            'CN22' => '海南',
            'CN24' => '四川',
            'CN25' => '贵州',
            'CN26' => '山西',
            'CN27' => '甘肃',
            'CN28' => '青海',
            'CN29' => '宁夏',
            'CN31' => '西藏',
            'CN32' => '新疆',
            'CN33' => '香港',
           /* 'CN34' => '台湾',*/
        ];
        return $states;
    }
    /**
     * [woocommerce_customer_meta_fields description]
     * @param  [type] $fields [description]
     * @return [type]         [description]
     */
    public function woocommerce_customer_meta_fields($fields){

        $fields = [


'billing' => array(
                'title' => __( 'Customer billing address', 'woocommerce' ),
                'fields' => array(

                    'billing_country' => array(
                        'label'       => __( 'Country', 'woocommerce' ),
                        'description' => '',
                        'class'       => 'js_field-country',
                        'type'        => 'select',
                        'options'     => array( '' => __( 'Select a country&hellip;', 'woocommerce' ) ) + WC()->countries->get_allowed_countries(),
                    ),
                    'billing_state' => array(
                        'label'       => __( 'State / County', 'woocommerce' ),
                        'description' => __( 'State / County or state code', 'woocommerce' ),
                        'class'       => 'js_field-state',
                    ),

                    'billing_city' => array(
                      /*  'type'        => 'city',*/
                        'label'       => __( 'City', 'woocommerce' ),
                        'description' => '',
                    ),
                    'billing_address_1' => array(
                        'label'       => __( 'Address line 1', 'woocommerce' ),
                        'description' => '',
                    ),
                    'billing_first_name' => array(
                        'label'       => __( 'First name', 'woocommerce' ),
                        'description' => '',
                    ),
/*                    'billing_postcode' => array(
                        'label'       => __( 'Postcode / ZIP', 'woocommerce' ),
                        'description' => '',
                    ),*/

                    'billing_phone' => array(
                        'label'       => __( 'Phone', 'woocommerce' ),
                        'description' => '',
                    ),
                    'billing_email' => array(
                        'label'       => __( 'Email address', 'woocommerce' ),
                        'description' => '',
                    ),
                ),
            ),
            'shipping' => array(
                'title' => __( 'Customer shipping address', 'woocommerce' ),
                'fields' => array(
                    'copy_billing' => array(
                        'label'       => __( 'Copy from billing address', 'woocommerce' ),
                        'description' => '',
                        'class'       => 'js_copy-billing',
                        'type'        => 'button',
                        'text'        => __( 'Copy', 'woocommerce' ),
                    ),

                    'shipping_country' => array(
                        'label'       => __( 'Country', 'woocommerce' ),
                        'description' => '',
                        'class'       => 'js_field-country',
                        'type'        => 'select',
                        'options'     => array( '' => __( 'Select a country&hellip;', 'woocommerce' ) ) + WC()->countries->get_allowed_countries(),
                    ),
                    'shipping_state' => array(
                        'label'       => __( 'State / County', 'woocommerce' ),
                        'description' => __( 'State / County or state code', 'woocommerce' ),
                        'class'       => 'js_field-state',
                    ),
                    'shipping_city' => array(
                        'label'       => __( 'City', 'woocommerce' ),
                        'description' => '',
                    ),
                    'shipping_address_1' => array(
                        'label'       => __( 'Address line 1', 'woocommerce' ),
                        'description' => '',
                    ),
                    'shipping_first_name' => array(
                        'label'       => __( 'First name', 'woocommerce' ),
                        'description' => '',
                    ),
                    'shipping_phone' => array(
                        'label'       => __( 'Phone', 'woocommerce' ),
                        'description' => '',
                    ),

                ),
            ),


        ];

        return $fields;
    }
/*======================*/

    public function woocommerce_checkout_posted_data($data){


            return $data;
    }



/*======================*/
}
/*EOF*/
