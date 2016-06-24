
       //cookie失效时间
       var x_expire = 60 * 60;
       //js接口的根路径 
       var  x_rootPath = "http://112.124.6.88:8099/if";
      // var x_rootPath = "http://localhost:6060/propagate";
	    /**
		 * 动态加载js
		 */
		var loadJS = function( id, fileUrl ) 
		{ 
			console.log("fileUrl:"+fileUrl);
	    	var oHead = document.getElementsByTagName('head').item(0); 
	    	var scriptTag = document.getElementById( id ); 
	    	if (scriptTag) oHead.removeChild(scriptTag); 
	    	var oScript= document.createElement("script"); 
	    	oScript.id = id; 
	    	oScript.type = "text/javascript";
	    	oScript.src=fileUrl ; 
	    	oHead.appendChild(oScript); 
	    	console.log(id+":");
	    	console.log(oScript);
	    	oScript.onload = oScript.onreadystatechange = function() { 
	    		if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete" ) { 
	    			// Handle memory leak in IE 
	    		    oScript.onload = oScript.onreadystatechange = null; 
	    		} 
			}; 
		}; 
		
		
		/**
		 * 获取项目根路径
		 */
		var getRootPath =  function(){
	   	    var curWwwPath=window.document.location.href;
	   	    var pathName=window.document.location.pathname;
	   	    var pos=curWwwPath.indexOf(pathName);
	   	    var localhostPaht=curWwwPath.substring(0,pos);
	   	    var projectName=pathName.substring(0,pathName.substr(1).indexOf('/')+1);
	   	    return(localhostPaht+projectName);
	   	};
	    
		/**
		 * 获取上下文路径
		 */
		function getContextPath() {
		    var pathName = document.location.pathname;
		    var index = pathName.substr(1).indexOf("/");
		    var result = pathName.substr(0,index+1);
		    return result;
		};

		
		/**
		 * 获取当前URL参数值
		 */
		var getUrlParam = function(e) {
			var t = new RegExp("(^|&)" + e + "=([^&]*)(&|$)");
			var n = window.location.search.substr(1).match(t);
			if (n != null) return unescape(n[2]);
			return null
		};
		
		//获取http协议中的url
		var getUrlFromHttp = function(e) {
			var t = /http:\/\/([^\/]+)\//i;
			var n = e.match(t);
			return n[1];
		};

		
		var getDomain = function(e) {
			if (!e) return "";
			if (e.indexOf("://") != -1) e = e.substr(e.indexOf("://") + 3);
			var t = ["com", "net", "org", "gov", "edu", "mil", "biz", "name", "info", "mobi", "pro", "travel", "museum", "int", "areo", "post", "rec", "im", "cn", "me"];
			var n = e.split(".");
			if (n.length <= 1) return e;
			if (!isNaN(n[n.length - 1])) return e;
			var r = ".com.cn";
			if (e.indexOf(r) != -1) {
				return n[n.length - 3] + "." + n[n.length - 2] + "." + n[n.length - 1]
			}
			var i = 0;
			while (i < t.length && t[i] != n[n.length - 1]) i++;
			if (i != t.length) return n[n.length - 2] + "." + n[n.length - 1];
			else {
				i = 0;
				while (i < t.length && t[i] != n[n.length - 2]) i++;
				if (i == t.length) return n[n.length - 2] + "." + n[n.length - 1];
				else return n[n.length - 3] + "." + n[n.length - 2] + "." + n[n.length - 1]
			}
		};

		//cookie 内容管理
		var cookieManager = {
			get: function(e) {
				var t = document.cookie.match(new RegExp("(^| )" + e + "=([^;] * )(; | $)"));
				if (t != null) return unescape(t[2]);
				return null
			},
			add: function(e, t, n) {
				var i = e + "=" + t;
				if (n != 0) {
					var date = new Date;
					var a = n * 1e3;
					date.setTime(date.getTime() + a);
					i +=  ";expires = "+date.toGMTString()
				}
				var s = getDomain(location.hostname);
					if (s != "") {
						i += ";domain = "+s
					}
					i+=";path = /";
					document.cookie = i
			}
		};



				var o = function(){
					var t = {
						setItem: function(t, n) {
							cookieManager.add(t, n, x_expire)
						},
						getItem: function(t) {
							return cookieManager.get(t)
						},
						removeItem: function(t) {
							cookieManager.add(t, "", -1)
						}
					};
					if (sessionStorage) {
						try {
							var o = ["REFER_DSCKID", "REFER_DSTIMESTAMP", "DS_FROM_TYPE"];
							var a = function() {
								if (document.referrer != "") {
									var e = getDomain(n(document.referrer));
									var t = getDomain(location.hostname);
									return e == t
								} else {
									return false
								}
							}();
							if (!a) {
								for (var s = 0; s < o.length; s++) {
									t.removeItem(o[s])
								}
							} else {
								for (var s = 0; s < o.length; s++) {
									var c = sessionStorage.getItem(o[s]);
									var u = t.getItem(o[s]);
									if ((c == null || c == "") && (u != null && u != "")) {
										sessionStorage.setItem(o[s], u)
									}
								}
							}
						} catch (f) {}
					}
					return {
						setItem: function(e, n) {
							sessionStorage && sessionStorage.setItem(e, n);
							t.setItem(e, n)
						},
						getItem: function(e) {
							if (sessionStorage) {
								return sessionStorage.getItem(e)
							} else {
								return t.getItem(e)
							}
						}
					}
				}();
				
				/**
				 *  替换URL中指定的参数值
				 */
				function replaceParamVal(href,paramName,replaceWith) {
				    var re=eval('/('+ paramName+'=)([^&]*)/gi');
				    var newUrl = href.replace(re,paramName+'='+replaceWith);
				    return newUrl;
				}	
				

         /**
		 * shareUrl后面添加articleId,originalOpenId参数
		 * 其中originalOpenId为cookie中的x_reader 
		 */
		var add4share = function(shareUrl){
			/* if(!shareUrl){
			  alert("分享链接不能为空。")
			  return;
			}*/
			  var articleId = o.getItem("x_articleId");
			  //originalOpenId为cookie中的x_reader 
			  var originalOpenId = o.getItem("x_reader");

			  var param = "";
			  if(shareUrl.indexOf("x_articleId") != -1){
				  //替换文章id为用户当前阅读的文章的id
				  shareUrl =  replaceParamVal(shareUrl,"x_articleId",articleId);
			  }else{
				   param = "x_articleId="+articleId;
			  }
			  if(shareUrl.indexOf("x_sharer") != -1){
				  //替换分享用户openId为当前用户的openId
				  shareUrl =  replaceParamVal(shareUrl,"x_sharer",originalOpenId);
			  }else{
				  if(param == ""){
					  param = "x_sharer="+originalOpenId;
				  }else{
					  param += "&x_sharer="+originalOpenId;
				  }
			  }

			  if(param != ""){
				  if(shareUrl.indexOf("?") > -1){
					  shareUrl += "&" + param;
				  }else{
					  shareUrl += "?" + param;
				  }
			  }

			  console.log(shareUrl);
			 // alert("分享链接为:"+decodeURIComponent(shareUrl));
			  return shareUrl;
		  }; 
	  
		  //add4share建立传播关系：originalUserid 传播给 userid
		  //测试add4share
	   	  // add4share(x_rootPath+"/userRecord/userappend.js");
	   	  
	   	  
	        /**
			 * 初始化信息
			 */
		  var saveReadOrShareRecord = function(){
		      //阅读者id
		      var openId = getUrlParam('x_reader');
		      //分享内容表id
		      var articleId = getUrlParam('x_articleId');
		  	  //访问文章的链接中必须含有参数： 阅读者openId和文章id
		  	  if(openId && articleId){
		  		 //阅读时的链接
			        var originalUrl =encodeURIComponent(window.location.href);
			        //分享者用户id
			        var originalOpenId =  getUrlParam('x_sharer');

			        // 分享类型
			        var shareType ; 
			        // 分享目标
			        var shareTarget ;      
			  	  //缓存参数：把链接url,文章id,阅读者id保存到cookie中
				   o.setItem('x_originalUrl', originalUrl); 
				   o.setItem('x_articleId', articleId); 
				   o.setItem('x_reader',openId); 
			  	  
			   	  console.log("userid:"+o.getItem("x_reader"));
			  	  console.log("articleId:"+o.getItem("x_articleId"));
			   	  console.log("originalUrl:"+o.getItem("x_originalUrl")); 
			  	  console.log("getRootPath:"+x_rootPath);
		  		     //加载userread.js，保存“阅读记录”
				  	 var jsUrl = x_rootPath+"/userRecord/userread.js?openId="+openId+"&articleId="+articleId;
			  		     if(originalOpenId){
				  			jsUrl+="&originalOpenId="+originalOpenId;
				  		 }
				  		 if(originalUrl){
					  		jsUrl+="&originalUrl="+originalUrl;
					  	 }
				  		 console.log("userread.js:"+jsUrl);
				  		 loadJS("userread",jsUrl);
				  	  
				   	  /**
				   	   * 从url中提取originalUserid参数，如果存在则保存"分享记录"
				   	   */
				  	  if(originalOpenId){
				  		 var userappendJSUrl = x_rootPath+"/userRecord/userappend.js?openId="+openId
				  		 +"&articleId="+articleId+"&originalOpenId="+originalOpenId;
				  		 if(originalUrl){
				  			userappendJSUrl+="&originalUrl="+originalUrl;
				  		 }
				  		 console.log("动态加载userappend.js:"+userappendJSUrl);
				  		 loadJS("userappend",userappendJSUrl);
				  	  }
		  	  }
		  };//end of saveReadOrShareRecord
		  
		  /**
		   * 保存微信用户信息
		   */
		  var sendUserInfo =  function(userinfoParam){
                //测试数据
			  /*userinfoParam = "openid=oCmwKv9ErXuGDmJYWGV2KSxEYj6A&nickname=小明" +
   		  	  "&language=zh_CN&unionid=1&province=广东&city=深圳" +
   		  	  "&country=中国&headimgurl=xxxx&privilege=xxxx&Ticket=xxxx&tagidist=xxxx";*/
	   		  var userinfoJsUrl = x_rootPath+ "/userRecord/userinfo.js?"+userinfoParam;
	   		 /* if(user.remark){  userinfoJsUrl+="&remark="+user.remark; } 
	   		  if(user.subscribe){  userinfoJsUrl+="&subscribe="+user.subscribe; } 
	   		  if(user.sex){  userinfoJsUrl+="&sex="+user.sex;  }   
	   		  if(user.subscribeTime){  userinfoJsUrl+="&subscribeTime="+user.subscribeTime; }  
	   		  if(user.groupid){ userinfoJsUrl+="&groupid="+user.groupid; } 
	   		  if(user.qrExpireSeconds){ userinfoJsUrl+="&qrExpireSeconds="+user.qrExpireSeconds;  }
	   		  if(user.qrCreateTime){ userinfoJsUrl+="&qrCreateTime="+user.qrCreateTime; }*/
			 console.log("动态加载userinfo.js:"+userinfoJsUrl);
			 loadJS("userinfo",userinfoJsUrl);
			 console.log("保存用户信息成功。")
	   	  };
		  
		  //保存阅读和分享记录
		  saveReadOrShareRecord();
	   	  

	     
	     
	     
	    	 
  