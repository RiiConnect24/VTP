<?php

function utc2snowflake($stamp)
{
bcscale(0);
return bcmul(bcsub(bcmul($stamp, 1000), '1288834974657'), '4194304');
}

function snowflake2utc($sf)
{
bcscale(0);
return bcdiv(bcadd(bcdiv($sf, '4194304'), '1288834974657'), '1000');
}
