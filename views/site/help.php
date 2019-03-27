<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 3/24/2019
 * Time: 4:01 AM
 */

/**@var $help string */
?>

<div class="card">
    <div class="card-header">Matlab File Format</div>
    <div class="card-body">
        <font color="gray">% function must take exactly 2 parameters</font><br>
        <font color="gray">% input: a json formatted input that will be provided from the form</font><br>
        <font color="gray">% dir: a folder path on the system with write access to write your produced images</font><br>
        <font color="blue">function</font> showp(input,dir)<br>


        <font color="gray">% decode json input to matlab variable</font><br>
        x = jsondecode(input);<br>

        <font color="gray">% in case <font color="red">jsondecode</font>  didn't work, the webserver is supplied with a custom json decoder, you can have it from this
            <a href="https://www.mathworksjsondecode.com/matlabcentral/fileexchange/33381-jsonlab-a-toolbox-to-encode-decode-json-files">link</a>
        </font><br>
        addpath('../jsonlab')<br>
        <font color="gray">% decode json input to matlab variable using jsonlab</font><br>
        x = loadjson(input);<br>

        <font color="gray">% write your logic, in this case we're drawing a barchart</font><br>
        bar(x);<br>

        <font color="gray">% save the image exactly like this one, you can change the file name</font><br>
        saveas(gcf,strcat(dir,'Barchart.png'));<br>

        <font color="gray">%output the saved file location for the webserver to know about it</font><br>
        disp('@start')<br>
        disp(strcat(dir,'Barchart.png'))<br>
        disp('@end')<br>
    </div>
</div>
