
                <tr class="tr_white" align="center">
                    <td height="28">[field:id/]</td>
                    <td>[field:panoname/]</td>
                    <td>[field:sendtime function='MyDate("Y-m-d H:i:s", @me)'/]</td>
                    <td>
                        <input type="button" class="btn1" value="设计" onclick="window.location.href='vrpano_edit.php?id=[field:id/]';"/>
                        <input type="button" class="btn1" value="删除" onclick="window.location.href='vrpano_del.php?id=[field:id/]';"/>
                        <input type="button" class="btn1" value="预览" onclick="penoshow('[field:id/]');"/>
                        <input type="button" class="btn1" value="生成静态" onclick="window.location.href='vrpano_maker.php?id=[field:id/]';"/>
                    </td>
                </tr>                
                