
var product = new Vue({
    delimiters: ['v{', '}'],
    el:'#productInfo',
    data:{
        skusInfo:null,
        goodsInfo:null,
        goodsAttr:[],
        attrMap:[],
        sku_group:[],
        sku:'',
        curSkuInfo:[],
        goodsCount:1,
        url:'',
    },
    methods:{
        getAttr:function(loc,pid,val){

            // 判断  此规格的 与 其他规格 组合与库存
            // 其他类型规格 不匹配 标记无货物 并 取消 相应 选中
            // 
            
            // 移除 class
            for(let i=0;i<this.attrMap.length;i++){
                let a = document.querySelector('#val'+this.attrMap[i]);
                a.classList.remove('selected');
            }
            this.sku_group[loc] = pid+':'+val; // 修改 attr 组合
            this.attrMap[loc] = val; // 样式 attr 映射
            // 添加 class
            for(let i=0;i<this.attrMap.length;i++){
                let a = document.querySelector('#val'+this.attrMap[i]);
                a.classList.add('selected');
            }
            
            let skuInfo = this.getGoodsInfo(); // 
            if(skuInfo)
                console.log(skuInfo);
            else
                console.log('该组合无商品库存');
            // this.
                
            
        },
        addToCar:function(){
            let data = {
                goodsCount:this.goodsCount,
                sku:this.sku,
                sku_id:this.curSkuInfo['id'],
                _token:token
            };
            axios.post('/cart/add',data)
            .then((res)=>{
                sidebar.renderCart(res.data)
            })

        },
        getSku:function(){
            this.sku = this.sku_group.join('-');
            return this.sku;
        },
        getGoodsInfo:function(){
            let sku = this.getSku(); // 计算 sku
            let skuInfo=null;
            for (let index = 0; index < this.skusInfo.length; index++) {
                const element = this.skusInfo[index];
                if(sku==element['sku']){
                    skuInfo=element
                    break; 
                }
            }
            if(skuInfo!=[] && skuInfo!=null)
            this.curSkuInfo = skuInfo;
            return skuInfo; // 返回匹配 到 的 sku 信息
        },
        updateInfo:function(){
            if(this.curSkuInfo==[] || this.curSkuInfo==null){
                alert('改规格无库存')
            }

        },
        goodsCountAdd:function(){
            this.goodsCount++;
        },
        goodsCountRed:function(){
            if(this.goodsCount-1<=0)
                return;
            this.goodsCount--;
        }

    },
    created:function(){
        // console.log(URL);
        this.goodsInfo = goodsInfo
        this.skusInfo = this.goodsInfo.skus
        this.goodsAttr = this.goodsInfo.attrs
        this.url = URL;
            // 初始化 默认选中 第一条 sku
        for(let i=0;i<this.goodsAttr.length;i++){
            
            let id = this.goodsAttr[i]['vals'][0]['id'];
            let parent_id = this.goodsAttr[i]['vals'][0]['parent_id'];
            this.goodsAttr[i]['select'] = id;
            this.attrMap[i] = id
            this.sku_group[i] = parent_id+':'+id
        }

        this.getGoodsInfo()

    },

    


})