<div class="ui-tab">
    <ul class="ui-tab-nav ui-border-b">
        <li>BMI</li>
        <li>体脂率</li>
        <li>肌肉率</li>
        <li>水分</li>
        <li>蛋白质</li>
        <li>内脏脂肪</li>
        <li>骨量</li>
        <li>基础代谢率</li>
        <li>身体年龄</li>
    </ul>
    <ul class="ui-tab-content" style="width:300%">
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/BMI.png" alt="">
                        <p>BMI</p>
                        <p>(<?= $health['bmi'] ?>)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>BMI(Body Mass lndex)是目前国际上常用
                            的简单衡量人体胖瘦的标准。世界各地BM
                            I衡量标准略有差异，我们使用的是适合亚
                            洲人体质的标准。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-nums table">
                        <span class="data-cw-24 table-cell">18.5</span>
                        <span class="data-cw-20 table-cell">24.0</span>
                        <span class="data-cw-20 table-cell">28.0</span>
                        <span class="data-cw-20 table-cell">35.0</span>
                    </div>
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell c1 data-cw-20" >
                            </div>
                            <div class="data-cell c2 data-cw-20" >
                            </div>
                            <div class="data-cell c3 data-cw-20" >
                            </div>
                            <div class="data-cell c5 data-cw-20" >
                            </div>
                            <div class="last data-cell c6 data-cw-20" >
                            </div>

                            <div class="data-val-cur" style="left: <?= bmi_left($health['bmi']) ?>">
                                <img src=<?= bmi_is_ok($health['bmi']) ?> alt="">
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span class="data-cw-20 table-cell">偏低</span>
                        <span class="data-cw-20 table-cell">正常</span>
                        <span class="data-cw-20 table-cell">偏胖</span>
                        <span class="data-cw-20 table-cell">肥胖</span>
                        <span class="data-cw-20 table-cell">极胖</span>
                    </div>
                </div>
                
                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>BMI肥胖</p>
                            <p>当前BMI指数较高，心脏病，高血压等疾
                                病发病风险较高，请注意改善生活习惯！</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>减脂原理是消耗大于摄入，当前需控制饮
                                食，增加运动消耗。有氧运动有助于脂肪
                                体重基数较大时不要选择对膝盖压力较大
                                的运动病发，可从走路，踩单车开始。</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/体脂率.png" alt="">
                        <p>体脂率</p>
                        <p>(<?= $health['fat'] ?>%)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>体脂率只人体内脂肪组织占体重的百分比
                            体重高不等于胖，但脂肪率高则是肥胖的
                            信号，减肥的根本是减脂。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-nums table">
                        <span class="data-cw-33 table-cell">10.5%</span>
                        <span class="data-cw-25 table-cell">24.0%</span>
                        <span class="data-cw-20 table-cell">26.0%</span>
                    </div>
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell c1 data-cw-25" >
                            </div>
                            <div class="data-cell c2 data-cw-25" >
                            </div>
                            <div class="data-cell c5 data-cw-25" >
                            </div>
                            <div class="last data-cell c6 data-cw-25" >
                            </div>

                            <div class="data-val-cur" style="left: <?= fat_left($health['fat']) ?>">
                                <img src=<?= fat_is_ok($health['fat']) ?> alt="">
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span class="data-cw-25 table-cell">偏低</span>
                        <span class="data-cw-25 table-cell">正常</span>
                        <span class="data-cw-25 table-cell">偏胖</span>
                        <span class="data-cw-25 table-cell">肥胖</span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>体脂率正常</p>
                            <p>恭喜你，体脂率为正常水准，要继续保持
                                哦！</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>注意保持锻炼，合理饮食！坚持运动可以
                                提高基础代谢，有助于消除工作带来的疲
                                劳，劳逸结合可以使工作效率更高哦！</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/肌肉率.png" alt="">
                        <p>肌肉率</p>
                        <p>(<?= $health['muscle'] ?>%)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>肌肉是指人体成分中肌肉占比体重的百分
                            比。肌肉率越高，基础代谢率越大，消耗
                            的热量越多，就不容易发胖。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-nums table">
                        <span class="data-cw-58 table-cell">50.0%</span>
                    </div>
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell c1 data-cw-50" >
                            </div>
                            <div class="last data-cell c2 data-cw-50" >
                            </div>
                            <div class="data-val-cur" style="left: <?= ($health['muscle']).'%' ?>">
                                <img src=<?= muscle_is_ok($health['muscle']) ?> alt="">
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span class="data-cw-50 table-cell">偏低</span>
                        <span class="data-cw-50 table-cell">标准</span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>BMI肥胖</p>
                            <p>当前BMI指数较高，心脏病，高血压等疾
                                病发病风险较高，请注意改善生活习惯！</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>减脂原理是消耗大于摄入，当前需控制饮
                                食，增加运动消耗。有氧运动有助于脂肪
                                体重基数较大时不要选择对膝盖压力较大
                                的运动病发，可从走路，踩单车开始。</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/水分.png" alt="">
                        <p>水分</p>
                        <p>(<?= $health['water'] ?>%)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>人体成分中水分占体重的百分比。充足的
                            水分可以促进新陈代谢。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-nums table">
                        <span class="data-cw-40 table-cell">55.0%</span>
                        <span class="data-cw-33 table-cell">65.0%</span>
                    </div>
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell c1 data-cw-33" >
                            </div>
                            <div class="data-cell c2 data-cw-33" >
                            </div>
                            <div class="last data-cell c5 data-cw-33" >
                            </div>
                            <div class="data-val-cur" style="left: <?= water_left($health['water']) ?>">
                                <img src=<?= water_is_ok($health['water']) ?> alt="">
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span class="data-cw-33 table-cell">偏低</span>
                        <span class="data-cw-33 table-cell">标准</span>
                        <span class="data-cw-33 table-cell">偏高</span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>水分正常</p>
                            <p>恭喜你水分达标达标，注意保持哦~</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>保持规律的饮食和作息，每天八杯水保持
                                正常水平。如有进行锻炼，请注意补充水
                                分，弥补出汗过多导致的水分流失。</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/蛋白质.png" alt="">
                        <p>蛋白质</p>
                        <p>(<?= $health['protein'] ?>%)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>蛋白质是组成人体的细胞组织的重要部分
                            约占人体全部质量的18%。机体所有重要
                            的组成部分都需要有蛋白质的参与，它是
                            生命活动的主要承担者。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-nums table">
                        <span class="data-cw-40 table-cell">16.0%</span>
                        <span class="data-cw-33 table-cell">20.0%</span>
                    </div>
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell c1 data-cw-33" >
                            </div>
                            <div class="data-cell c2 data-cw-33" >
                            </div>
                            <div class="last data-cell c5 data-cw-33" >
                            </div>
                            <div class="data-val-cur" style="left: <?= protein_left($health['protein']) ?>">
                                <img src=<?= protein_is_ok($health['protein']) ?> alt="">
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span class="data-cw-33 table-cell">偏低</span>
                        <span class="data-cw-33 table-cell">标准</span>
                        <span class="data-cw-33 table-cell">偏高</span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>蛋白质标准</p>
                            <p>恭喜你蛋白质达标，注意保持哦~</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>不过分节食，保持营养均衡，就能维持
                                稳定的蛋白质水平啦！</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/内脏脂肪.png" alt="">
                        <p>内脏率</p>
                        <p>(<?= $health['visceralfat'] ?>%)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>内脏脂肪是人体脂肪中的一种，与皮下脂
                            肪不同，主要存在于腹腔内，围绕着人的
                            脏器。一定的脂肪可以起到支撑，稳定，
                            保护内脏的作用。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-nums table">
                        <span class="data-cw-33 table-cell">10%</span>
                        <span class="data-cw-33 table-cell">15%</span>
                    </div>
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell c2 data-cw-33" >
                            </div>
                            <div class="data-cell c5 data-cw-33" >
                            </div>
                            <div class="last data-cell c6 data-cw-33" >
                            </div>
                            <div class="data-val-cur" style="left: <?= visceralfat_left($health['visceralfat']) ?>">
                                <img src=<?= visceralfat_is_ok($health['visceralfat']) ?> alt="">
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span class="data-cw-33 table-cell">正常</span>
                        <span class="data-cw-33 table-cell">偏高</span>
                        <span class="data-cw-33 table-cell">超高</span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>体脂率标准</p>
                            <p>内脏脂肪水平正常，适当的内脏脂肪可以
                                大幅降低心脑血管疾病的发病危险哦！</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>均衡膳食没拒绝高热量食物，保持规律的
                                作息，健康会一直陪伴着您哒！</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/骨量.png" alt="">
                        <p>骨量</p>
                        <p>(<?= $health['bone'] ?>kg)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p>骨量是指人体成分中骨组织的数量。骨组织是一种坚硬的
                            结缔组织，也是由细胞，纤维和基质构成的。纤维为
                            骨胶纤维（和胶原纤维一样），基质含有大量的固体
                            无机盐。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell data-cw-100 c2 last" >
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span style="width: 100%;" class="table-cell">你的骨量：<?= $health['bone'] ?>kg，
                            占体重<?= to_percent($health['bone']/$health['weight']) ?></span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>骨量标准</p>
                            <p>你的骨量水平标准，短期内不会发生明显
                                的变化。</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>每天饭后步行20分钟，适当到户外晒太阳
                                有助于钙质的吸收。平常可以从牛奶，豆
                                制品，鱼，动物骨头等食物中获取钙质。</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/基础代谢率.png" alt="">
                        <p>基础代谢率</p>
                        <p>(<?= $health['bmr'] ?>)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p> 基础代谢率（BMR）是指人体在清醒而又极端安
                            静的状态下，不受肌肉活动，环境温度，食物及精神
                            紧张等影响时的能量带代谢率。基础代谢率越高，你
                            每天所消耗的热量就越多，也就不容易发胖。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell data-cw-100 c2 last" >
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span style="width: 100%;" class="table-cell">
                            你的基础代谢率：<?= $health['bmr'] ?>大卡/天
                        </span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>基础代谢率</p>
                            <p>恭喜你，你的基础代谢率在标准水平！提
                                高基础代谢率，身体能耗会相应增加，就
                                不容易发胖。</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>基础代谢率与饮食，作息和运动息息相关
                                保持健康作息和均衡膳食，坚持每周至少
                                运动一次，脂肪永远找不上面咯！</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="info">
                <div class="info-know table">
                    <div class="table-cell info-know-name">
                        <img src="/images/身体年龄.png" alt="">
                        <p>身体年龄</p>
                        <p>(<?= $health['bodyage'] ?>)</p>
                    </div>

                    <div style="text-align: left;" class="table-cell">
                        <p> 身体年龄是以基础代谢率为基础，综合体重，身
                            高，脂肪，肌肉等数值，换算所得出的数值。所以身
                            体年龄是一个高于或低于实际年龄的综合判断标准。</p>
                    </div>
                </div>
                <div class="data-img">
                    <div class="data-slide">
                        <div class="data">
                            <div class="first data-cell data-cw-100 c2 last" >
                            </div>
                        </div>
                    </div>
                    <div class="data-val table">
                        <span style="width: 100%;" class="table-cell">
                            你的身体年龄：<?= $health['bodyage'] ?>岁
                        </span>
                    </div>
                </div>

                <div class="info-detail">
                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/体脂率正常.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p>身体年龄偏大</p>
                            <p>您的身体年龄高于实际年龄，表明身体机
                                能略有老化，熬夜，缺乏运动都输导致身
                                体年龄偏高。</p>
                        </div>
                    </div>

                    <div class="table">
                        <div class="table-cell tip">
                            <p><img src="/images/灯泡.png" alt=""></p>
                        </div>
                        <div class="table-cell cnt">
                            <p style="color: #7acc2a;">此处有妙招</p>
                            <p>您的身体年龄高于实际年龄，表明身体机
                                能略有老化，熬夜，缺乏运动都输导致身
                                体年龄偏高。</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>


<script src="/javascript/vendor/zepto.js"></script>
<script src="/javascript/vendor/frozen.js"></script>
<script>
    (function (){
        var tab = new fz.Scroll('.ui-tab', {
            role: 'tab',
            autoplay: false,
            interval: 3000
        });
        <?php if (!empty($tab)) { ?>
            var cur_tab = <?= $tab ?>;
            tab.scrollToElement($('.ui-tab-content').children()[cur_tab]);
            getFourTab(cur_tab);
            tab.currentPage = cur_tab;
        <?php } ?>
        /* 滑动结束时,参数为当前位置 */
        tab.on('scrollEnd', function(curPage) {
            getFourTab(curPage);
        });

        //通过当前的tab位置读取4个tab，实现tab自动滚动
        function getFourTab(cur_tab) {
            $('.ui-tab-nav').children().each(function (idx, itm) {
                $(itm).css('display', 'none');
                $(itm).removeClass('current');
            });
            for (var i = 0; i<4;i++) {
                var cur = (cur_tab+i) % 9;
                $($('.ui-tab-nav').children()[cur]).css('display', 'block');
            }
            $($('.ui-tab-nav').children()[cur_tab]).addClass('current');
        }
    })();
</script>
