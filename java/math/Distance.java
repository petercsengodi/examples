public class Distance {

	public static double distance(CustomVector p1, CustomVector p2) {
		double dx = p1.getX() - p2.getX();
		double dy = p1.getY() - p2.getY();
		double dz = p1.getZ() - p2.getZ();

		return Math.sqrt(dx*dx + dy*dy + dz*dz);
	}

	public static CustomVector avg(CustomVector p1, CustomVector p2) {
		double px = p1.getX() + p2.getX();
		double py = p1.getY() + p2.getY();
		double pz = p1.getZ() + p2.getZ();

		return new CustomVector(px / 2.0, py / 2.0, pz / 2.0);
	}

	public static CustomVector avg(CustomVector p1, CustomVector p2, CustomVector p3) {
		double px = p1.getX() + p2.getX() + p3.getX();
		double py = p1.getY() + p2.getY() + p3.getY();
		double pz = p1.getZ() + p2.getZ() + p3.getZ();

		return new CustomVector(px / 3.0, py / 3.0, pz / 3.0);
	}

	public static void minimize(CustomVector a, CustomVector b, CustomVector to) {
		to.x = Math.min(a.x, b.x);
		to.y = Math.min(a.y, b.y);
		to.z = Math.min(a.z, b.z);
		to.w = Math.min(a.w, b.w);
	}

	public static void maximize(CustomVector a, CustomVector b, CustomVector to) {
		to.x = Math.max(a.x, b.x);
		to.y = Math.max(a.y, b.y);
		to.z = Math.max(a.z, b.z);
		to.w = Math.max(a.w, b.w);
	}
}

