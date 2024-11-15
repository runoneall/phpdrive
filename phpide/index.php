<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
ul li ul {
    display:none;
}

</style>

<script src="/phpide/jquery.js"></script>
<script>
$(document).ready(function(e) {
    $("ul li").click(function(e) {
        $(this).children("ul").toggle();
        e.stopPropagation(); //阻止冒泡事件
    });
});
</script>
</head>

<body>
<ul>
    <li>目录1
        <ul>
        <li>目录1.1
            <ul>
            <li>目录1.1.1</li>
            <li>目录1.1.2</li>
            </ul>
        </li>
        <li>目录1.2
            <ul>
            <li>目录1.2.1</li>
            <li>目录1.2.2</li>
            <li>目录1.2.3</li>
            </ul>
        </li>
        <li>目录1.3
            <ul>
            <li>目录1.3.1</li>
            <li>目录1.3.2</li>
            <li>目录1.3.3</li>
            </ul>
        </li>
        </ul>
    </li>
    
    <li>目录2
        <ul>
        <li>目录2.1</li>
        <li>目录2.2</li>
        <li>目录2.3</li>
        </ul>
    </li>
    
    <li>目录3
        <ul>
        <li>目录3.1</li>
        <li>目录3.2</li>
        <li>目录3.3</li>
        </ul>
    </li>
</ul>
</body>
</html>