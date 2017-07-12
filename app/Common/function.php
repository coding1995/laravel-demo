<?php

function getGoodSortNameById($id){

		if( $id==0 ){

			return "顶级分类";
		}
		return \App\GoodSort::find($id)->name;

}
